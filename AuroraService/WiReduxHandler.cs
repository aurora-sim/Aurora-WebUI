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
using Aurora.DataManager;
using Aurora.Framework;
using Aurora.Services.DataService;
using OpenMetaverse.StructuredData;

namespace OpenSim.Server.Handlers.Caps
{
    public class WireduxHandler : IService
    {
        private static readonly ILog m_log = LogManager.GetLogger(MethodBase.GetCurrentMethod().DeclaringType);
        public IHttpServer m_server = null;
        public string Name
        {
            get { return GetType().Name; }
        }

        public void Initialize(IConfigSource config, IRegistryCore registry)
        {
        }

        public void PostInitialize(IConfigSource config, IRegistryCore registry)
        {
        }

        public void Start(IConfigSource config, IRegistryCore registry)
        {
        }

        public void PostStart(IConfigSource config, IRegistryCore registry)
        {
            IConfig handlerConfig = config.Configs["Handlers"];
            if (handlerConfig.GetString("WireduxHandler", "") != Name)
                return;
            m_server = registry.RequestModuleInterface<ISimulationBase>().GetHttpServer(handlerConfig.GetUInt("WireduxHandlerPort"));

            string Password = handlerConfig.GetString("WireduxHandlerPassword", String.Empty);
            if (Password != "")
            {
                //This handler allows sims to post CAPS for their sims on the CAPS server.
                m_server.AddStreamHandler(new WireduxHTTPHandler(Password, registry));
            }
        }

        public void AddNewRegistry(IConfigSource config, IRegistryCore registry)
        {
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
            m_password = pass;
        }

        public override byte[] Handle(string path, Stream requestData,
                OSHttpRequest httpRequest, OSHttpResponse httpResponse)
        {
            StreamReader sr = new StreamReader(requestData);
            string body = sr.ReadToEnd();
            sr.Close();
            body = body.Trim();

            //m_log.DebugFormat("[XXX]: query String: {0}", body);
            string method = string.Empty;
            try
            {
                OSDMap map = (OSDMap)OSDParser.DeserializeJson(body);
                //Make sure that the person who is calling can access the web service
                if (VerifyPassword(map))
                {
                    method = map["Method"].AsString();
                    if (method == "Login")
                    {
                        return ProcessLogin(map);
                    }
                    else if (method == "CreateAccount")
                    {
                        return ProcessCreateAccount(map);
                    }
                }
            }
            catch (Exception)
            {
            }
            OSDMap resp = new OSDMap();
            resp.Add("response", OSD.FromString("Failed"));
            string xmlString = OSDParser.SerializeJsonString(resp);
            UTF8Encoding encoding = new UTF8Encoding();
            return encoding.GetBytes(xmlString);
        }

        private bool VerifyPassword(OSDMap map)
        {
            if (map.ContainsKey("WebPassword"))
            {
                return map["WebPassword"] == m_password;
            }
            return false;
        }

        private byte[] ProcessCreateAccount(OSDMap map)
        {
            bool Verified = false;
            string FirstName = map["First"].AsString();
            string LastName = map["Last"].AsString();
            string PasswordHash = map["PasswordHash"].AsString();
            string PasswordSalt = map["PasswordSalt"].AsString();
            string HomeRegion = map["HomeRegion"].AsString();
            string Email = map["Email"].AsString();

            ILoginService loginService = m_registry.RequestModuleInterface<ILoginService>();
            IUserAccountService accountService = m_registry.RequestModuleInterface<IUserAccountService>();
            if (accountService == null)
                return null;

            accountService.CreateUser(FirstName, LastName, PasswordHash, Email);

            Verified = accountService.GetUserAccount(UUID.Zero, FirstName, LastName) != null;
            OSDMap resp = new OSDMap();
            resp["Verified"] = OSD.FromBoolean(Verified);
            string xmlString = OSDParser.SerializeJsonString(resp);
            UTF8Encoding encoding = new UTF8Encoding();
            return encoding.GetBytes(xmlString);
        }

        private byte[] ProcessLogin(OSDMap map)
        {
            bool Verified = false;
            string FirstName = map["First"].AsString();
            string LastName = map["Last"].AsString();
            string Password = map["Password"].AsString();

            ILoginService loginService = m_registry.RequestModuleInterface<ILoginService>();
            UUID secureSessionID;
            UUID userID = UUID.Zero;

            LoginResponse loginresp = loginService.VerifyClient(FirstName, LastName, Password, UUID.Zero, false, "", out secureSessionID);
            //Null means it went through without an error
            Verified = loginresp == null;
            if (Verified)
            {
                userID = m_registry.RequestModuleInterface<IUserAccountService>().GetUserAccount(UUID.Zero, FirstName, LastName).PrincipalID;
            }
            OSDMap resp = new OSDMap();
            resp["Verified"] = OSD.FromBoolean(Verified);
            resp["UUID"] = OSD.FromUUID(userID);
            string xmlString = OSDParser.SerializeJsonString(resp);
            UTF8Encoding encoding = new UTF8Encoding();
            return encoding.GetBytes(xmlString);
        }
    }
}
