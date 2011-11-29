/*
 * Copyright (c) Contributors, http://aurora-sim.org/
 * See CONTRIBUTORS.TXT for a full list of copyright holders.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *     * Redistributions of source code must retain the above copyright
 *       notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *     * Neither the name of the Aurora-Sim Project nor the
 *       names of its contributors may be used to endorse or promote products
 *       derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE DEVELOPERS ``AS IS'' AND ANY
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE CONTRIBUTORS BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

using System;
using System.Collections;
using System.Collections.Generic;
using System.IO;
using System.Net;
using System.Reflection;
using System.Text;
using log4net;
using Nini.Config;
using Aurora.Simulation.Base;
using OpenSim.Services.Interfaces;
using OpenSim.Framework;
using OpenSim.Framework.Servers.HttpServer;

using OpenMetaverse;
using OpenMetaverse.Imaging;
using Aurora.DataManager;
using Aurora.Framework;
using Aurora.Services.DataService;
using OpenMetaverse.StructuredData;

using System.Collections.Specialized;

using System.Drawing;
using System.Drawing.Text;
using System.Drawing.Drawing2D;
using System.Drawing.Imaging;
using GridRegion = OpenSim.Services.Interfaces.GridRegion;
using BitmapProcessing;
using RegionFlags = Aurora.Framework.RegionFlags;

namespace OpenSim.Services
{
    public class WireduxHandler : IService
    {
        private static readonly ILog m_log = LogManager.GetLogger(MethodBase.GetCurrentMethod().DeclaringType);
        public IHttpServer m_server = null;
        public IHttpServer m_server2 = null;
        string m_servernick = "hippogrid";
        protected IRegistryCore m_registry;
        public string Name
        {
            get { return GetType().Name; }
        }

        public void Initialize(IConfigSource config, IRegistryCore registry)
        {
        }

        public void Start(IConfigSource config, IRegistryCore registry)
        {
            if (config.Configs["GridInfoService"] != null)
                m_servernick = config.Configs["GridInfoService"].GetString("gridnick", m_servernick);
            m_registry = registry;
            IConfig handlerConfig = config.Configs["Handlers"];
            string name = handlerConfig.GetString("WireduxHandler", "");
            if (name != Name)
                return;
            string Password = handlerConfig.GetString("WireduxHandlerPassword", String.Empty);
            if (Password != "")
            {
                m_server = registry.RequestModuleInterface<ISimulationBase>().GetHttpServer(handlerConfig.GetUInt("WireduxHandlerPort"));
                //This handler allows sims to post CAPS for their sims on the CAPS server.
                m_server.AddStreamHandler(new WireduxHTTPHandler(Password, registry));
                m_server2 = registry.RequestModuleInterface<ISimulationBase>().GetHttpServer(handlerConfig.GetUInt("WireduxTextureServerPort"));
                m_server2.AddHTTPHandler("GridTexture", OnHTTPGetTextureImage);
                m_server2.AddHTTPHandler("MapTexture", OnHTTPGetMapImage);

                MainConsole.Instance.Commands.AddCommand ("webui add user", "Adds an admin user for WebUI", "webui add user", AddUser);
                MainConsole.Instance.Commands.AddCommand ("webui remove user", "Removes an admin user for WebUI", "webui add user", RemoveUser);
            }
        }

        public void FinishedStartup()
        {
        }

        public Hashtable OnHTTPGetTextureImage(Hashtable keysvals)
        {
            Hashtable reply = new Hashtable();

            if (keysvals["method"].ToString() != "GridTexture")
                return reply;

            m_log.Debug("[WebUI]: Sending image jpeg");
            int statuscode = 200;
            byte[] jpeg = new byte[0];
            IAssetService m_AssetService = m_registry.RequestModuleInterface<IAssetService>();

            MemoryStream imgstream = new MemoryStream();
            Bitmap mapTexture = new Bitmap(1, 1);
            ManagedImage managedImage;
            Image image = (Image)mapTexture;

            try
            {
                // Taking our jpeg2000 data, decoding it, then saving it to a byte array with regular jpeg data

                imgstream = new MemoryStream();

                // non-async because we know we have the asset immediately.
                AssetBase mapasset = m_AssetService.Get(keysvals["uuid"].ToString());

                // Decode image to System.Drawing.Image
                if (OpenJPEG.DecodeToImage(mapasset.Data, out managedImage, out image))
                {
                    // Save to bitmap

                    mapTexture = ResizeBitmap(image, 128, 128);
                    EncoderParameters myEncoderParameters = new EncoderParameters();
                    myEncoderParameters.Param[0] = new EncoderParameter(System.Drawing.Imaging.Encoder.Quality, 75L);

                    // Save bitmap to stream
                    mapTexture.Save(imgstream, GetEncoderInfo("image/jpeg"), myEncoderParameters);



                    // Write the stream to a byte array for output
                    jpeg = imgstream.ToArray();
                }
            }
            catch (Exception)
            {
                // Dummy!
                m_log.Warn("[WebUI]: Unable to post image.");
            }
            finally
            {
                // Reclaim memory, these are unmanaged resources
                // If we encountered an exception, one or more of these will be null
                if (mapTexture != null)
                    mapTexture.Dispose();

                if (image != null)
                    image.Dispose();

                if (imgstream != null)
                {
                    imgstream.Close();
                    imgstream.Dispose();
                }
            }


            reply["str_response_string"] = Convert.ToBase64String(jpeg);
            reply["int_response_code"] = statuscode;
            reply["content_type"] = "image/jpeg";

            return reply;
        }

        public Hashtable OnHTTPGetMapImage(Hashtable keysvals)
        {
            Hashtable reply = new Hashtable();

            if (keysvals["method"].ToString() != "MapTexture")
                return reply;

            int zoom = 20;
            int x = 0;
            int y = 0;

            if (keysvals.ContainsKey("zoom"))
                zoom = int.Parse(keysvals["zoom"].ToString());
            if (keysvals.ContainsKey("x"))
                x = (int)float.Parse(keysvals["x"].ToString());
            if (keysvals.ContainsKey("y"))
                y = (int)float.Parse(keysvals["y"].ToString());

            m_log.Debug("[WebUI]: Sending map image jpeg");
            int statuscode = 200;
            byte[] jpeg = new byte[0];
            
            MemoryStream imgstream = new MemoryStream();
            Bitmap mapTexture = CreateZoomLevel(zoom, x, y);
            EncoderParameters myEncoderParameters = new EncoderParameters();
            myEncoderParameters.Param[0] = new EncoderParameter(System.Drawing.Imaging.Encoder.Quality, 75L);

            // Save bitmap to stream
            mapTexture.Save(imgstream, GetEncoderInfo("image/jpeg"), myEncoderParameters);

            // Write the stream to a byte array for output
            jpeg = imgstream.ToArray();

            // Reclaim memory, these are unmanaged resources
            // If we encountered an exception, one or more of these will be null
            if (mapTexture != null)
                mapTexture.Dispose();

            if (imgstream != null)
            {
                imgstream.Close();
                imgstream.Dispose();
            }

            reply["str_response_string"] = Convert.ToBase64String(jpeg);
            reply["int_response_code"] = statuscode;
            reply["content_type"] = "image/jpeg";

            return reply;
        }

        public Bitmap ResizeBitmap(Image b, int nWidth, int nHeight)
        {
            Bitmap newsize = new Bitmap(nWidth, nHeight);
            Graphics temp = Graphics.FromImage(newsize);
            temp.DrawImage(b, 0, 0, nWidth, nHeight);
            temp.SmoothingMode = SmoothingMode.AntiAlias;
            temp.DrawString(m_servernick, new Font("Arial", 8, FontStyle.Regular), new SolidBrush(Color.FromArgb(90, 255, 255, 50)), new Point(2, 115));

            return newsize;
        }

        private Bitmap CreateZoomLevel(int zoomLevel, int centerX, int centerY)
        {
            if (!Directory.Exists("MapTiles"))
                Directory.CreateDirectory("MapTiles");

            string fileName = Path.Combine("MapTiles", "Zoom" + zoomLevel + "X" + centerX + "Y" + centerY + ".jpg");
            if (File.Exists(fileName))
            {
                DateTime lastWritten = File.GetLastWriteTime(fileName);
                if ((DateTime.Now - lastWritten).Minutes < 10) //10 min cache
                    return (Bitmap)Bitmap.FromFile(fileName);
            }

            List<GridRegion> regions = m_registry.RequestModuleInterface<IGridService>().GetRegionRange(UUID.Zero,
                    (int)(centerX * (int)Constants.RegionSize - (zoomLevel * (int)Constants.RegionSize)),
                    (int)(centerX * (int)Constants.RegionSize + (zoomLevel * (int)Constants.RegionSize)),
                    (int)(centerY * (int)Constants.RegionSize - (zoomLevel * (int)Constants.RegionSize)),
                    (int)(centerY * (int)Constants.RegionSize + (zoomLevel * (int)Constants.RegionSize)));
            List<Image> bitImages = new List<Image>();
            List<FastBitmap> fastbitImages = new List<FastBitmap>();

            foreach (GridRegion r in regions)
            {
                AssetBase texAsset = m_registry.RequestModuleInterface<IAssetService>().Get(r.TerrainImage.ToString());

                if (texAsset != null)
                {
                    ManagedImage managedImage;
                    Image image;
                    if (OpenJPEG.DecodeToImage(texAsset.Data, out managedImage, out image))
                    {
                        bitImages.Add(image);
                        fastbitImages.Add(new FastBitmap((Bitmap)image));
                    }
                }
            }

            int imageSize = 2560;
            float zoomScale = (imageSize / zoomLevel);
            Bitmap mapTexture = new Bitmap(imageSize, imageSize);
            Graphics g = Graphics.FromImage(mapTexture);
            Color seaColor = Color.FromArgb(29, 71, 95);
            SolidBrush sea = new SolidBrush(seaColor);
            g.FillRectangle(sea, 0, 0, imageSize, imageSize);

            for (int i = 0; i < regions.Count; i++)
            {
                float x = ((regions[i].RegionLocX - (centerX * (float)Constants.RegionSize) + Constants.RegionSize / 2) / (float)Constants.RegionSize);
                float y = ((regions[i].RegionLocY - (centerY * (float)Constants.RegionSize) + Constants.RegionSize / 2) / (float)Constants.RegionSize);

                int regionWidth = regions[i].RegionSizeX / Constants.RegionSize;
                int regionHeight = regions[i].RegionSizeY / Constants.RegionSize;
                float posX = (x * zoomScale) + imageSize / 2;
                float posY = (y * zoomScale) + imageSize / 2;
                g.DrawImage(bitImages[i], posX, imageSize - posY, zoomScale * regionWidth, zoomScale * regionHeight); // y origin is top
            }

            mapTexture.Save(fileName, ImageFormat.Jpeg);

            return mapTexture;
        }

        // From msdn
        private static ImageCodecInfo GetEncoderInfo(String mimeType)
        {
            ImageCodecInfo[] encoders;
            encoders = ImageCodecInfo.GetImageEncoders();
            for (int j = 0; j < encoders.Length; ++j)
            {
                if (encoders[j].MimeType == mimeType)
                    return encoders[j];
            }
            return null;
        }

        private void AddUser (string[] cmd)
        {
            string name = MainConsole.Instance.CmdPrompt ("Name of user");
            UserAccount acc = m_registry.RequestModuleInterface<IUserAccountService> ().GetUserAccount (UUID.Zero, name);
            if (acc == null)
            {
                m_log.Warn ("No such user exists");
                return;
            }
            IAgentInfo agent = Aurora.DataManager.DataManager.RequestPlugin<IAgentConnector> ().GetAgent (acc.PrincipalID);
            agent.OtherAgentInformation["WebUIEnabled"] = true;
            Aurora.DataManager.DataManager.RequestPlugin<IAgentConnector> ().UpdateAgent (agent);
            m_log.Warn ("Admin added");
        }

        private void RemoveUser (string[] cmd)
        {
            string name = MainConsole.Instance.CmdPrompt ("Name of user");
            UserAccount acc = m_registry.RequestModuleInterface<IUserAccountService> ().GetUserAccount (UUID.Zero, name);
            if (acc == null)
            {
                m_log.Warn ("No such user exists");
                return;
            }
            IAgentInfo agent = Aurora.DataManager.DataManager.RequestPlugin<IAgentConnector> ().GetAgent (acc.PrincipalID);
            agent.OtherAgentInformation["WebUIEnabled"] = false;
            Aurora.DataManager.DataManager.RequestPlugin<IAgentConnector> ().UpdateAgent (agent);
            m_log.Warn ("Admin removed");
        }
    }

    public class WireduxHTTPHandler : BaseStreamHandler
    {
        private static readonly ILog m_log = LogManager.GetLogger(MethodBase.GetCurrentMethod().DeclaringType);

        protected string m_password;
        protected IRegistryCore m_registry;

        public WireduxHTTPHandler(string pass, IRegistryCore reg) :
            base("POST", "/WIREDUX")
        {
            m_registry = reg;
            m_password = Util.Md5Hash(pass);

        }

        public override byte[] Handle(string path, Stream requestData,
                OSHttpRequest httpRequest, OSHttpResponse httpResponse)
        {
            StreamReader sr = new StreamReader(requestData);
            string body = sr.ReadToEnd();
            sr.Close();
            body = body.Trim();

            //m_log.DebugFormat("[XXX]: query String: {0}", body);
            m_log.TraceFormat("[WebUI]: query String: {0}", body);
            string method = string.Empty;
            OSDMap resp = new OSDMap();
            try
            {
                OSDMap map = (OSDMap)OSDParser.DeserializeJson(body);
                //Make sure that the person who is calling can access the web service
                if (VerifyPassword(map))
                {
                    method = map["Method"].AsString();
                    if (method == "Login")
                    {
                        resp = ProcessLogin(map);
                    }
                    else if (method == "AdminLogin")
                    {
                        resp = ProcessAdminLogin(map);
                    }
                    else if (method == "CreateAccount")
                    {
                        resp = ProcessCreateAccount(map);
                    }
                    else if (method == "OnlineStatus")
                    {
                        resp = ProcessOnlineStatus(map);
                    }
                    else if (method == "Authenticated")
                    {
                        resp = Authenticated(map);
                    }
                    else if (method == "GetGridUserInfo")
                    {
                        resp = GetGridUserInfo(map);
                    }
                    else if (method == "ChangePassword")
                    {
                        resp = ChangePassword(map);
                    }
                    else if (method == "CheckIfUserExists")
                    {
                        resp = CheckIfUserExists(map);
                    }
                    else if (method == "SaveEmail")
                    {
                        resp = SaveEmail(map);
                    }
                    else if (method == "ChangeName")
                    {
                        resp = ChangeName(map);
                    }
                    else if (method == "ConfirmUserEmailName")
                    {
                        resp = ConfirmUserEmailName(map);
                    }
                    else if (method == "ForgotPassword")
                    {
                        resp = ForgotPassword(map);
                    }
                    else if (method == "GetProfile")
                    {
                        resp = GetProfile(map);
                    }
                    else if (method == "GetAvatarArchives")
                    {
                        resp = GetAvatarArchives(map);
                    }
                    else if (method == "DeleteUser")
                    {
                        resp = DeleteUser(map);
                    }
                    else if (method == "BanUser")
                    {
                        resp = BanUser(map);
                    }
                    else if (method == "TempBanUser")
                    {
                        resp = TempBanUser(map);
                    }
                    else if (method == "UnBanUser")
                    {
                        resp = UnBanUser(map);
                    }
                    else if (method == "FindUsers")
                    {
                        resp = FindUsers(map);
                    }
                    else if (method == "GetAbuseReports")
                    {
                        resp = GetAbuseReports(map);
                    }
                    else if (method == "AbuseReportSaveNotes")
                    {
                        resp = AbuseReportSaveNotes(map);
                    }
                    else if (method == "AbuseReportMarkComlete")
                    {
                        resp = AbuseReportMarkComlete(map);
                    }
                    else if(method == "SetWebLoginKey")
                    {
                        resp = SetWebLoginKey(map);
                    }
                    else if(method == "EditUser")
                    {
                        resp = EditUser(map);
                    }
                    else if (method == "GetRegions")
                    {
                        resp = GetRegions(map);
                    }
                    else
                    {
                        m_log.TraceFormat("[WebUI] Unsupported method called ({0})", method);
                    }
                }
                else
                {
                    m_log.Debug("Password does not match");
                }
            }
            catch (Exception e)
            {
                m_log.TraceFormat("[WebUI] Exception thrown: " + e.ToString());
            }
            if(resp.Count == 0){
                resp.Add("response", OSD.FromString("Failed"));
            }
            UTF8Encoding encoding = new UTF8Encoding();
            httpResponse.ContentType = "application/json";
            return encoding.GetBytes(OSDParser.SerializeJsonString(resp, true));
        }

        private bool VerifyPassword(OSDMap map)
        {
            return map.ContainsKey("WebPassword") && (map["WebPassword"] == m_password);
        }

        private OSDMap CheckIfUserExists(OSDMap map)
        {
            IUserAccountService accountService = m_registry.RequestModuleInterface<IUserAccountService>();
            UserAccount user = accountService.GetUserAccount(UUID.Zero, map["Name"].AsString());

            bool Verified = user != null;
            OSDMap resp = new OSDMap();
            resp["Verified"] = OSD.FromString(Verified.ToString());
            return resp;
        }

        private OSDMap ProcessCreateAccount(OSDMap map)
        {
            bool Verified = false;
            string Name = map["Name"].AsString();
            string PasswordHash = map["PasswordHash"].AsString();
            //string PasswordSalt = map["PasswordSalt"].AsString();
            string HomeRegion = map["HomeRegion"].AsString();
            string Email = map["Email"].AsString();
            string AvatarArchive = map["AvatarArchive"].AsString();
            int userLevel = map["UserLevel"].AsInteger();
  

            IUserAccountService accountService = m_registry.RequestModuleInterface<IUserAccountService>();
            if (accountService == null)
                return null;

            if (!PasswordHash.StartsWith("$1$"))
                PasswordHash = "$1$" + Util.Md5Hash(PasswordHash);
            PasswordHash = PasswordHash.Remove(0, 3); //remove $1$

            accountService.CreateUser(Name, PasswordHash, Email);
            UserAccount user = accountService.GetUserAccount(UUID.Zero, Name);
            IAgentInfoService agentInfoService = m_registry.RequestModuleInterface<IAgentInfoService> ();
            IGridService gridService = m_registry.RequestModuleInterface<IGridService> ();
            if (agentInfoService != null && gridService != null)
            {
                GridRegion r = gridService.GetRegionByName (UUID.Zero, HomeRegion);
                if (r != null)
                {
                    agentInfoService.SetHomePosition(user.PrincipalID.ToString(), r.RegionID, new Vector3(r.RegionSizeX / 2, r.RegionSizeY / 2, 20), Vector3.Zero);
                }
                else
                {
                    m_log.DebugFormat("[WebUI]: Could not set home position for user {0}, region \"{1}\" did not produce a result from the grid service", user.PrincipalID.ToString(), HomeRegion);
                }
            }

            Verified = user != null;
            UUID userID = UUID.Zero;

            if (Verified)
            {
                userID = user.PrincipalID;
                user.UserLevel = userLevel;

                // could not find a way to save this data here.
                DateTime RLDOB = map["RLDOB"].AsDate();
                string RLFirstName = map["RLFisrtName"].AsString();
                string RLLastName = map["RLLastName"].AsString();
                string RLAddress = map["RLAdress"].AsString();
                string RLCity = map["RLCity"].AsString();
                string RLZip = map["RLZip"].AsString();
                string RLCountry = map["RLCountry"].AsString();
                string RLIP = map["RLIP"].AsString();
                IAgentConnector con = Aurora.DataManager.DataManager.RequestPlugin<IAgentConnector> ();
                con.CreateNewAgent (userID);
                IAgentInfo agent = con.GetAgent (userID);
                agent.OtherAgentInformation["RLDOB"] = RLDOB;
                agent.OtherAgentInformation["RLFirstName"] = RLFirstName;
                agent.OtherAgentInformation["RLLastName"] = RLLastName;
                agent.OtherAgentInformation["RLAddress"] = RLAddress;
                agent.OtherAgentInformation["RLCity"] = RLCity;
                agent.OtherAgentInformation["RLZip"] = RLZip;
                agent.OtherAgentInformation["RLCountry"] = RLCountry;
                agent.OtherAgentInformation["RLIP"] = RLIP;
                con.UpdateAgent (agent);
                
                accountService.StoreUserAccount(user);

                IProfileConnector profileData = DataManager.RequestPlugin<IProfileConnector>();
                IUserProfileInfo profile = profileData.GetUserProfile(user.PrincipalID);
                if (profile == null)
                {
                    profileData.CreateNewProfile(user.PrincipalID);
                    profile = profileData.GetUserProfile(user.PrincipalID);
                }
                if (AvatarArchive.Length > 0)
                    profile.AArchiveName = AvatarArchive + ".database";

                profile.IsNewUser = true;
                profileData.UpdateUserProfile(profile);
            }

            OSDMap resp = new OSDMap();
            resp["Verified"] = OSD.FromBoolean(Verified);
            resp["UUID"] = OSD.FromUUID(userID);
            return resp;
        }

        private OSDMap ProcessLogin(OSDMap map)
        {
            bool Verified = false;
            string Name = map["Name"].AsString();
            string Password = map["Password"].AsString();

            ILoginService loginService = m_registry.RequestModuleInterface<ILoginService>();
            UUID secureSessionID;
            UserAccount account = null;
            OSDMap resp = new OSDMap ();

            LoginResponse loginresp = loginService.VerifyClient(Name, "UserAccount", Password, UUID.Zero, false, "", "", "", out secureSessionID);
            //Null means it went through without an error
            Verified = loginresp == null;
            if (Verified)
            {
                account = m_registry.RequestModuleInterface<IUserAccountService> ().GetUserAccount (UUID.Zero, Name);
                resp["UUID"] = OSD.FromUUID (account.PrincipalID);
                resp["FirstName"] = OSD.FromString (account.FirstName);
                resp["LastName"] = OSD.FromString (account.LastName);
            }

            resp["Verified"] = OSD.FromBoolean (Verified);

            return resp;
        }

        private OSDMap ProcessAdminLogin(OSDMap map)
        {
            bool Verified = false;
            string Name = map["Name"].AsString();
            string Password = map["Password"].AsString();

            ILoginService loginService = m_registry.RequestModuleInterface<ILoginService>();
            UUID secureSessionID;
            UUID userID = UUID.Zero;
            OSDMap resp = new OSDMap ();

            LoginResponse loginresp = loginService.VerifyClient (Name, "UserAccount", Password, UUID.Zero, false, "", "", "", out secureSessionID);
            //Null means it went through without an error
            Verified = loginresp == null;
            if (Verified)
            {
                UserAccount account = m_registry.RequestModuleInterface<IUserAccountService> ().GetUserAccount (UUID.Zero, Name);
                IAgentInfo agent = Aurora.DataManager.DataManager.RequestPlugin<IAgentConnector> ().GetAgent (account.PrincipalID);
                if (agent.OtherAgentInformation["WebUIEnabled"].AsBoolean ()) //Admin flag
                {
                    resp["UUID"] = OSD.FromUUID (account.PrincipalID);
                    resp["FirstName"] = OSD.FromString (account.FirstName);
                    resp["LastName"] = OSD.FromString (account.LastName);
                }
                else
                    Verified = false;
            }


            resp["Verified"] = OSD.FromBoolean(Verified);

            return resp;
        }

        private OSDMap ProcessOnlineStatus(OSDMap map)
        {
            ILoginService loginService = m_registry.RequestModuleInterface<ILoginService>();
            bool LoginEnabled = loginService.MinLoginLevel == 0;

            OSDMap resp = new OSDMap();
            resp["Online"] = OSD.FromInteger(1);
            resp["LoginEnabled"] = OSD.FromInteger(LoginEnabled ? 1 : 0);

            return resp;
        }

        private OSDMap Authenticated(OSDMap map)
        {
            IUserAccountService accountService = m_registry.RequestModuleInterface<IUserAccountService>();
            UserAccount user = accountService.GetUserAccount(UUID.Zero, map["UUID"].AsUUID());

            bool Verified = user != null;
            OSDMap resp = new OSDMap();
            resp["Verified"] = OSD.FromBoolean(Verified);

            if (Verified)
            {
                user.UserLevel = 0;
                accountService.StoreUserAccount(user);
            }

            return resp;
        }

        /// <summary>
        /// Gets user information for change user info page on site
        /// </summary>
        /// <param name="map">UUID</param>
        /// <returns>Verified, HomeName, HomeUUID, Online, Email, FirstName, LastName</returns>
        OSDMap GetGridUserInfo(OSDMap map)
        {
            string uuid = String.Empty;
            uuid = map["UUID"].AsString();

            IUserAccountService accountService = m_registry.RequestModuleInterface<IUserAccountService>();
            UserAccount user = accountService.GetUserAccount(UUID.Zero, map["UUID"].AsUUID());
            IAgentInfoService agentService = m_registry.RequestModuleInterface<IAgentInfoService>();

            UserInfo userinfo;
            OSDMap resp = new OSDMap();

            bool verified = user != null;
            resp["Verified"] = OSD.FromBoolean(verified);
            if (verified)
            {
                userinfo = agentService.GetUserInfo(uuid);
                IGridService gs = m_registry.RequestModuleInterface<IGridService>();
                Services.Interfaces.GridRegion gr = gs.GetRegionByUUID(UUID.Zero, userinfo.HomeRegionID);

                resp["HomeUUID"] = OSD.FromUUID(userinfo.HomeRegionID);
                resp["HomeName"] = OSD.FromString(gr.RegionName);
                resp["Online"] = OSD.FromBoolean(userinfo.IsOnline);
                resp["Email"] = OSD.FromString(user.Email);
                resp["Name"] = OSD.FromString(user.Name);
            }

            return resp;
        }

        /// <summary>
        /// After conformation the email is saved
        /// </summary>
        /// <param name="map">UUID, Email</param>
        /// <returns>Verified</returns>
        OSDMap SaveEmail(OSDMap map)
        {
            string email = map["Email"].AsString();

            IUserAccountService accountService = m_registry.RequestModuleInterface<IUserAccountService>();
            UserAccount user = accountService.GetUserAccount(UUID.Zero, map["UUID"].AsUUID());
            OSDMap resp = new OSDMap();

            bool verified = user != null;
            resp["Verified"] = OSD.FromBoolean(verified);
            if (verified)
            {
                user.Email = email;
                user.UserLevel = 0;
                accountService.StoreUserAccount(user);
            }
            return resp;
        }

        /// <summary>
        /// Changes user name
        /// </summary>
        /// <param name="map">UUID, FirstName, LastName</param>
        /// <returns>Verified</returns>
        OSDMap ChangeName(OSDMap map)
        {
            IUserAccountService accountService = m_registry.RequestModuleInterface<IUserAccountService>();
            UserAccount user = accountService.GetUserAccount(UUID.Zero, map["UUID"].AsUUID());
            OSDMap resp = new OSDMap();

            bool verified = user != null;
            resp["Verified"] = OSD.FromBoolean(verified);
            if (verified)
            {
                user.Name = map["Name"].AsString();
                accountService.StoreUserAccount(user);
            }

            return resp;
        }

        OSDMap ChangePassword(OSDMap map)
        {
            string Password = map["Password"].AsString();
            string newPassword = map["NewPassword"].AsString();

            ILoginService loginService = m_registry.RequestModuleInterface<ILoginService>();
            UUID secureSessionID;
            UUID userID = map["UUID"].AsUUID();


            IAuthenticationService auths = m_registry.RequestModuleInterface<IAuthenticationService>();

            LoginResponse loginresp = loginService.VerifyClient (userID, "UserAccount", Password, UUID.Zero, false, "", "", "", out secureSessionID);
            OSDMap resp = new OSDMap();
            //Null means it went through without an error
            bool Verified = loginresp == null;

            if ((auths.Authenticate(userID, "UserAccount", Util.Md5Hash(Password), 100) != string.Empty) && (Verified))
            {
                auths.SetPassword (userID, "UserAccount", newPassword);
                resp["Verified"] = OSD.FromBoolean(Verified);
            }

            return resp;
        }

        OSDMap ForgotPassword(OSDMap map)
        {
            UUID UUDI = map["UUID"].AsUUID();
            string Password = map["Password"].AsString();

            IUserAccountService accountService = m_registry.RequestModuleInterface<IUserAccountService>();
            UserAccount user = accountService.GetUserAccount(UUID.Zero, UUDI);

            OSDMap resp = new OSDMap();
            bool verified = user != null;
            resp["Verified"] = OSD.FromBoolean(verified);
            resp["UserLevel"] = OSD.FromInteger(0);
            if (verified)
            {
                resp["UserLevel"] = OSD.FromInteger(user.UserLevel);
                if (user.UserLevel >= 0)
                {
                    IAuthenticationService auths = m_registry.RequestModuleInterface<IAuthenticationService>();
                    auths.SetPassword (user.PrincipalID, "UserAccount", Password);
                }
                else
                {
                    resp["Verified"] = OSD.FromBoolean(false);
                }
            }

            return resp;
        }

        OSDMap ConfirmUserEmailName(OSDMap map)
        {
            string Name = map["Name"].AsString();
            string Email = map["Email"].AsString();

            OSDMap resp = new OSDMap();
            resp["Verified"] = OSD.FromBoolean(false);
            resp["Error"] = OSD.FromString("");
            IUserAccountService accountService = m_registry.RequestModuleInterface<IUserAccountService>();
            UserAccount user = accountService.GetUserAccount(UUID.Zero, Name);
            bool verified = user != null;

            if (verified)
            {
                if (user.UserLevel >= 0)
                {
                    resp["UUID"] = OSD.FromUUID(user.PrincipalID);
                    if (user.Email.ToLower() == Email.ToLower())
                    {
                        resp["Verified"] = OSD.FromBoolean(true);
                    }
                    else
                    {
                        resp["Error"] = OSD.FromString("Email does not match the user name.");
                    }
                }
                else
                {
                    resp["Error"] = OSD.FromString("This account is disabled.");
                }
            }
            else
            {
                resp["Error"] = OSD.FromString("No such user.");
            }


            return resp;
        }

        OSDMap GetProfile(OSDMap map)
        {
            OSDMap resp = new OSDMap();
            string Name = map["Name"].AsString();
            UUID userID = map["UUID"].AsUUID();

            UserAccount account = Name != "" ? 
                m_registry.RequestModuleInterface<IUserAccountService>().GetUserAccount(UUID.Zero, Name) :
                 m_registry.RequestModuleInterface<IUserAccountService>().GetUserAccount(UUID.Zero, userID);
            if (account != null)
            {
                OSDMap accountMap = new OSDMap();
                accountMap["Created"] = account.Created;
                accountMap["Name"] = account.Name;
                accountMap["PrincipalID"] = account.PrincipalID;
                accountMap["Email"] = account.Email;
                TimeSpan diff = DateTime.Now - Util.ToDateTime(account.Created);
                int years = (int)diff.TotalDays / 356;
                int days = years > 0 ? (int)diff.TotalDays / years : (int)diff.TotalDays;
                accountMap["TimeSinceCreated"] = years + " years, " + days + " days";
                IProfileConnector profileConnector = Aurora.DataManager.DataManager.RequestPlugin<IProfileConnector>();
                IUserProfileInfo profile = profileConnector.GetUserProfile(account.PrincipalID);
                if (profile != null)
                {
                    resp["profile"] = profile.ToOSD(false);//not trusted, use false

                    if (account.UserFlags == 0)
                        account.UserFlags = 2; //Set them to no info given
                    string flags = ((IUserProfileInfo.ProfileFlags)account.UserFlags).ToString();
                    IUserProfileInfo.ProfileFlags.NoPaymentInfoOnFile.ToString();

                    accountMap["AccountInfo"] = (profile.CustomType != "" ? profile.CustomType :
                        account.UserFlags == 0 ? "Resident" : "Admin") + "\n" + flags;
                    UserAccount partnerAccount = m_registry.RequestModuleInterface<IUserAccountService>().GetUserAccount(UUID.Zero, profile.Partner);
                    if (partnerAccount != null)
                        accountMap["Partner"] = partnerAccount.Name;
                    else
                        accountMap["Partner"] = "";
                }
                IAgentConnector agentConnector = Aurora.DataManager.DataManager.RequestPlugin<IAgentConnector>();
                IAgentInfo agent = agentConnector.GetAgent(account.PrincipalID);
                if(agent != null)
                {
                    OSDMap agentMap = new OSDMap();
                    agentMap["RLName"] = agent.OtherAgentInformation["RLName"];
                    agentMap["RLAddress"] = agent.OtherAgentInformation["RLAddress"];
                    agentMap["RLZip"] = agent.OtherAgentInformation["RLZip"];
                    agentMap["RLCity"] = agent.OtherAgentInformation["RLCity"];
                    agentMap["RLCountry"] = agent.OtherAgentInformation["RLCountry"];
                    resp["agent"] = agentMap;
                }
                resp["account"] = accountMap;
            }

            return resp;
        }

        OSDMap EditUser (OSDMap map)
        {
            OSDMap resp = new OSDMap();
            UUID principalID = map["UserID"].AsUUID();
            UserAccount account = m_registry.RequestModuleInterface<IUserAccountService>().GetUserAccount(UUID.Zero, principalID);
            if(account != null)
            {
                account.Email = map["Email"];
                if(m_registry.RequestModuleInterface<IUserAccountService>().GetUserAccount(UUID.Zero, map["Name"].AsString()) == null)
                    account.Name = map["Name"];
                IAgentConnector agentConnector = Aurora.DataManager.DataManager.RequestPlugin<IAgentConnector>();
                IAgentInfo agent = agentConnector.GetAgent(account.PrincipalID);
                if(agent == null)
                {
                    agentConnector.CreateNewAgent(account.PrincipalID);
                    agent = agentConnector.GetAgent(account.PrincipalID);
                }
                if(agent != null)
                {
                    agent.OtherAgentInformation["RLName"] = map["RLName"];
                    agent.OtherAgentInformation["RLAddress"] = map["RLAddress"];
                    agent.OtherAgentInformation["RLZip"] = map["RLZip"];
                    agent.OtherAgentInformation["RLCity"] = map["RLCity"];
                    agent.OtherAgentInformation["RLCountry"] = map["RLCountry"];
                    agentConnector.UpdateAgent(agent);
                }
                m_registry.RequestModuleInterface<IUserAccountService>().StoreUserAccount(account);
            }
            return resp;
        }

        OSDMap GetAvatarArchives(OSDMap map)
        {
            OSDMap resp = new OSDMap();
            List<AvatarArchive> temp = DataManager.RequestPlugin<IAvatarArchiverConnector>().GetAvatarArchives(true);

            string names = "";
            string snapshot = "";

            m_log.DebugFormat("[WebUI] {0} avatar archives found", temp.Count);

            foreach (AvatarArchive a in temp)
            {
                names += a.Name + ",";
                snapshot += a.Snapshot + ",";
            }
            if (names.Length > 0)
            {
                resp["names"] = names.Substring(0, names.Length - 1);
                resp["snapshot"] = snapshot.Substring(0, snapshot.Length - 1);
                resp["Verified"] = OSD.FromBoolean(true);
            }
            else
            {
                resp["Verified"] = OSD.FromBoolean(false);
            }


            return resp;
        }

        OSDMap DeleteUser(OSDMap map)
        {
            OSDMap resp = new OSDMap();
            UUID agentID = map["UserID"].AsUUID();
            IAgentInfo GetAgent = DataManager.RequestPlugin<IAgentConnector>().GetAgent(agentID);

            if (GetAgent == null)
            {
                resp["Finished"] = OSD.FromBoolean(true);
            }
            else
            {
                GetAgent.Flags &= ~IAgentFlags.PermBan;
                DataManager.RequestPlugin<IAgentConnector>().UpdateAgent(GetAgent);

                resp["Finished"] = OSD.FromBoolean(true);
            }
            return resp;
        }

        OSDMap BanUser(OSDMap map)
        {
            OSDMap resp = new OSDMap();
            UUID agentID = map["UserID"].AsUUID();
            IAgentInfo GetAgent = DataManager.RequestPlugin<IAgentConnector>().GetAgent(agentID);

            if (GetAgent == null)
            {
                resp["Finished"] = OSD.FromBoolean(true);
            }
            else
            {
                GetAgent.Flags &= ~IAgentFlags.PermBan;
                DataManager.RequestPlugin<IAgentConnector>().UpdateAgent(GetAgent);

                resp["Finished"] = OSD.FromBoolean(true);
            }

            return resp;
        }

        OSDMap TempBanUser(OSDMap map)
        {
            OSDMap resp = new OSDMap();
            UUID agentID = map["UserID"].AsUUID();
            IAgentInfo GetAgent = DataManager.RequestPlugin<IAgentConnector>().GetAgent(agentID);

            if (GetAgent == null)
            {
                resp["Finished"] = OSD.FromBoolean(true);
            }
            else
            {
                GetAgent.Flags &= ~IAgentFlags.TempBan;
                GetAgent.OtherAgentInformation["TemperaryBanInfo"] = resp["BannedUntil"];
                DataManager.RequestPlugin<IAgentConnector>().UpdateAgent(GetAgent);

                resp["Finished"] = OSD.FromBoolean(true);
            }

            return resp;
        }

        OSDMap UnBanUser(OSDMap map)
        {
            OSDMap resp = new OSDMap();
            UUID agentID = map["UserID"].AsUUID();
            IAgentInfo GetAgent = DataManager.RequestPlugin<IAgentConnector>().GetAgent(agentID);

            if (GetAgent == null)
            {
                resp["Finished"] = OSD.FromBoolean(true);
            }
            else
            {
                GetAgent.Flags &= IAgentFlags.PermBan;
                DataManager.RequestPlugin<IAgentConnector>().UpdateAgent(GetAgent);

                resp["Finished"] = OSD.FromBoolean(true);
            }

            return resp;
        }

        OSDMap FindUsers(OSDMap map)
        {
            OSDMap resp = new OSDMap();
            int start = map["Start"].AsInteger();
            int end = map["End"].AsInteger();
            string Query = map["Query"].AsString();
            List<UserAccount> accounts = m_registry.RequestModuleInterface<IUserAccountService>().GetUserAccounts(UUID.Zero, Query);

            OSDArray users = new OSDArray();
            for(int i = start; i < end && i < accounts.Count; i++)
            {
                UserAccount acc = accounts[i];
                OSDMap userInfo = new OSDMap();
                userInfo["PrincipalID"] = acc.PrincipalID;
                userInfo["UserName"] = acc.Name;
                userInfo["Created"] = acc.Created;
                userInfo["UserFlags"] = acc.UserFlags;
                users.Add(userInfo);
            }
            resp["Users"] = users;

            resp["Finished"] = OSD.FromBoolean(true);

            return resp;
        }

        OSDMap GetAbuseReports(OSDMap map)
        {
            OSDMap resp = new OSDMap();
            IAbuseReports ar = m_registry.RequestModuleInterface<IAbuseReports>();

            List<AbuseReport> lar = ar.GetAbuseReports(map["start"].AsInteger(), map["count"].AsInteger(), map["filter"].AsString());
            OSDArray returnvalue = new OSDArray();
            foreach (AbuseReport tar in lar)
            {
                returnvalue.Add(tar.ToOSD());
            }
            resp["abusereports"] = returnvalue;

            return resp;
        }

        OSDMap AbuseReportMarkComlete(OSDMap map)
        {
            OSDMap resp = new OSDMap();
            IAbuseReports ar = m_registry.RequestModuleInterface<IAbuseReports>();
            AbuseReport tar = ar.GetAbuseReport(map["Number"].AsInteger(), map["WebPassword"].AsString());
            tar.Active = false;
            ar.UpdateAbuseReport(tar, map["WebPassword"].AsString());
            resp["Finished"] = OSD.FromBoolean(true);

            return resp;
        }

        OSDMap AbuseReportSaveNotes(OSDMap map)
        {
            OSDMap resp = new OSDMap();
            IAbuseReports ar = m_registry.RequestModuleInterface<IAbuseReports>();
            AbuseReport tar = ar.GetAbuseReport(map["Number"].AsInteger(), map["WebPassword"].AsString());
            tar.Notes = map["Notes"].ToString();
            ar.UpdateAbuseReport(tar, map["WebPassword"].AsString());
            resp["Finished"] = OSD.FromBoolean(true);

            return resp;
        }

        OSDMap SetWebLoginKey(OSDMap map)
        {
            OSDMap resp = new OSDMap ();
            UUID principalID = map["PrincipalID"].AsUUID();
            UUID webLoginKey = UUID.Random();
            IAuthenticationService authService = m_registry.RequestModuleInterface<IAuthenticationService> ();
            if (authService != null)
            {
                //Remove the old
                Aurora.DataManager.DataManager.RequestPlugin<IAuthenticationData> ().Delete (principalID, "WebLoginKey");
                authService.SetPlainPassword(principalID, "WebLoginKey", webLoginKey.ToString());
                resp["WebLoginKey"] = webLoginKey;
            }
            resp["Failed"] = OSD.FromString(String.Format("No auth service, cannot set WebLoginKey for user {0}.", map["PrincipalID"].AsUUID().ToString()));

            return resp;
        }

        OSDMap GetRegions(OSDMap map)
        {
            OSDMap resp = new OSDMap();
            RegionFlags type = RegionFlags.RegionOnline;
            if (map.Keys.Contains("RegionFlags"))
            {
                type = (RegionFlags)map["RegionFlags"].AsInteger();
            }
            IRegionData regiondata = Aurora.DataManager.DataManager.RequestPlugin<IRegionData>();
            List<GridRegion> regions = regiondata.Get(type);
            foreach (GridRegion region in regions)
            {
                OSDMap kvpairs = new OSDMap();
                foreach(KeyValuePair<string, object> entry in region.ToKeyValuePairs()){
                    kvpairs[entry.Key] = entry.Value.ToString();
                    if( entry.Key == "locX" ||
                        entry.Key == "locY" ||
                        entry.Key == "sizeX" ||
                        entry.Key == "sizeY" ||
                        entry.Key == "serverHttpPort"
                    ){
                        kvpairs[entry.Key] = (OSDInteger)kvpairs[entry.Key].AsInteger();
                    }
                }
                if (region.ToKeyValuePairs().ContainsKey("Flags") == false){
                    kvpairs["Flags"] = region.Flags;
                }
                if (region.ToKeyValuePairs().ContainsKey("SessionID") == false)
                {
                    kvpairs["SessionID"] = region.SessionID;
                }
                if (region.ToKeyValuePairs().ContainsKey("EstateOwner") == false)
                {
                    kvpairs["EstateOwner"] = region.EstateOwner;
                }
                if (region.ToKeyValuePairs().ContainsKey("locZ") == false)
                {
                    kvpairs["locZ"] = (OSDInteger)region.RegionLocZ;
                }
                if (region.ToKeyValuePairs().ContainsKey("sizeZ") == false)
                {
                    kvpairs["sizeZ"] = (OSDInteger)region.RegionSizeZ;
                }
                resp[region.RegionID.ToString()] = kvpairs;
            }
            return resp;
        }
    }
}