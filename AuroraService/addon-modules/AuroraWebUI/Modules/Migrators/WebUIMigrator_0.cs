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
using System.Collections.Generic;
using C5;

using Aurora.Framework;
using Aurora.DataManager.Migration;

namespace Aurora.Addon.WebUI.Migrators
{
    public class WebUI_0 : Migrator
    {
        public WebUI_0()
        {
            Version = new Version(0, 0, 0);
            MigrationName = "Wiredux";

            schema = new List<Rec<string, ColumnDefinition[], IndexDefinition[]>>(6);

            #region wi_adminmodules

            schema.Add(new Rec<string, ColumnDefinition[], IndexDefinition[]>(
                "wi_adminmodules",
                new ColumnDefinition[20]{
                    new ColumnDefinition{
                        Name = "id",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.Integer,
                            Size = 11,
                            auto_increment = true
                        }
                    },
                    new ColumnDefinition{
                        Name = "displayTopPanelSlider",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 10
                        }
                    },
                    new ColumnDefinition{
                        Name = "displayTemplateSelector",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 10
                        }
                    },
                    new ColumnDefinition{
                        Name = "displayStyleSwitcher",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 10
                        }
                    },
                    new ColumnDefinition{
                        Name = "displayStyleSizer",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 10
                        }
                    },
                    new ColumnDefinition{
                        Name = "displayFontSizer",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 10
                        }
                    },
                    new ColumnDefinition{
                        Name = "displayLanguageSelector",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 10
                        }
                    },
                    new ColumnDefinition{
                        Name = "displayScrollingText",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 10
                        }
                    },
                    new ColumnDefinition{
                        Name = "displayWelcomeMessage",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 10
                        }
                    },
                    new ColumnDefinition{
                        Name = "displayLogo",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 10
                        }
                    },
                    new ColumnDefinition{
                        Name = "displayLogoEffect",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 10
                        }
                    },
                    new ColumnDefinition{
                        Name = "displaySlideShow",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 10
                        }
                    },
                    new ColumnDefinition{
                        Name = "displayMegaMenu",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 10
                        }
                    },
                    new ColumnDefinition{
                        Name = "displayDate",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 10
                        }
                    },
                    new ColumnDefinition{
                        Name = "displayTime",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 10
                        }
                    },
                    new ColumnDefinition{
                        Name = "displayRoundedCorner",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 10
                        }
                    },
                    new ColumnDefinition{
                        Name = "displayBackgroundColorAnimation",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 10
                        }
                    },
                    new ColumnDefinition{
                        Name = "displayPageLoadTime",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 10
                        }
                    },
                    new ColumnDefinition{
                        Name = "displayW3c",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 10
                        }
                    },
                    new ColumnDefinition{
                        Name = "displayRss",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 10
                        }
                    },
                }, new IndexDefinition[1]{
                    new IndexDefinition{
                        Fields = new string[1]{ "id" },
                        Type = IndexType.Primary
                    }
                }
            ));

            #endregion

            #region wi_adminsetting

            schema.Add(new Rec<string, ColumnDefinition[], IndexDefinition[]>(
                "wi_adminsetting",
                new ColumnDefinition[11]{
                    new ColumnDefinition{
                        Name = "id",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.Integer,
                            Size = 11,
                            auto_increment = true
                        }
                    },
                    new ColumnDefinition{
                        Name = "startregion",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 255
                        }
                    },
                    new ColumnDefinition{
                        Name = "userdir",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 255
                        }
                    },
                    new ColumnDefinition{
                        Name = "griddir",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 255
                        }
                    },
                    new ColumnDefinition{
                        Name = "assetdir",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 255
                        }
                    },
                    new ColumnDefinition{
                        Name = "lastnames",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 10
                        }
                    },
                    new ColumnDefinition{
                        Name = "adress",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 32
                        }
                    },
                    new ColumnDefinition{
                        Name = "region",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.Text
                        }
                    },
                    new ColumnDefinition{
                        Name = "allowRegistrations",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 10
                        }
                    },
                    new ColumnDefinition{
                        Name = "verifyUsers",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 10
                        }
                    },
                    new ColumnDefinition{
                        Name = "ForceAge",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.Integer,
                            Size = 11
                        }
                    }
                }, new IndexDefinition[1]{
                    new IndexDefinition{
                        Fields = new string[1]{ "id" },
                        Type = IndexType.Primary
                    }
                }
            ));

            #endregion

            #region wi_appearance

            schema.Add(new Rec<string, ColumnDefinition[], IndexDefinition[]>(
                "wi_appearance",
                new ColumnDefinition[3]{
                    new ColumnDefinition{
                        Name = "Enabled",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 36,
                            defaultValue = ""
                        }
                    },
                    new ColumnDefinition{
                        Name = "Picture",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 32
                        }
                    },
                    new ColumnDefinition{
                        Name = "ArchiveName",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 32
                        }
                    }
                }, new IndexDefinition[1]{
                    new IndexDefinition{
                        Fields = new string[1]{ "ArchiveName" },
                        Type = IndexType.Primary
                    }
                }
            ));

            #endregion

            #region wi_banned

            schema.Add(new Rec<string, ColumnDefinition[], IndexDefinition[]>(
                "wi_banned",
                new ColumnDefinition[3]{
                    new ColumnDefinition{
                        Name = "UUID",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 36
                        }
                    },
                    new ColumnDefinition{
                        Name = "agentIP",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 255
                        }
                    },
                    new ColumnDefinition{
                        Name = "time",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 255
                        }
                    }
                }, new IndexDefinition[0]
            ));

            #endregion

            #region wi_codetable

            schema.Add(new Rec<string, ColumnDefinition[], IndexDefinition[]>(
                "wi_codetable",
                new ColumnDefinition[5]{
                    new ColumnDefinition{
                        Name = "UUID",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 36
                        }
                    }, new ColumnDefinition{
                        Name = "code",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 255
                        }
                    }, new ColumnDefinition{
                        Name = "info",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 255
                        }
                    }, new ColumnDefinition{
                        Name = "email",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 255
                        }
                    }, new ColumnDefinition{
                        Name = "time",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 255
                        }
                    }
                }, new IndexDefinition[0]
            ));

            #endregion

            #region wi_country

            schema.Add(new Rec<string, ColumnDefinition[], IndexDefinition[]>(
                "wi_country",
                new ColumnDefinition[1]{
                    new ColumnDefinition{
                        Name = "name",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 100
                        }
                    }
                }, new IndexDefinition[0]
            ));

            #endregion

            #region wi_lastnames

            schema.Add(new Rec<string, ColumnDefinition[], IndexDefinition[]>(
                "wi_lastnames",
                new ColumnDefinition[]{
                    new ColumnDefinition{
                        Name = "name",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 255
                        }
                    },
                    new ColumnDefinition{
                        Name = "active",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 255,
                            defaultValue = "1"
                        }
                    }
                }, new IndexDefinition[0]
            ));

            #endregion

            #region wi_pagemanager

            schema.Add(new Rec<string, ColumnDefinition[], IndexDefinition[]>(
                "wi_pagemanager",
                new ColumnDefinition[7]{
                    new ColumnDefinition{
                        Name = "id",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 255
                        }
                    }, new ColumnDefinition{
                        Name = "rank",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.Float
                        }
                    }, new ColumnDefinition{
                        Name = "active",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 30
                        }
                    }, new ColumnDefinition{
                        Name = "url",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.Text
                        }
                    }, new ColumnDefinition{
                        Name = "target",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 255
                        }
                    }, new ColumnDefinition{
                        Name = "display",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 255
                        }
                    }, new ColumnDefinition{
                        Name = "parent",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 255,
                            isNull = true,
                            defaultValue = "NULL"
                        }
                    }
                }, new IndexDefinition[1]{
                    new IndexDefinition{
                        Fields = new string[1]{ "id" },
                        Type = IndexType.Primary
                    }
                }
            ));

            #endregion

            #region wi_regions

            schema.Add(new Rec<string, ColumnDefinition[], IndexDefinition[]>(
                "wi_regions",
                new ColumnDefinition[7]{
                    new ColumnDefinition{
                        Name = "serverIP",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 64
                        }
                    },
                    new ColumnDefinition{
                        Name = "serverPort",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.Integer,
                            Size = 11
                        }
                    },
                    new ColumnDefinition{
                        Name = "regionMapTexture",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 255
                        }
                    },
                    new ColumnDefinition{
                        Name = "locX",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.Integer,
                            Size = 11
                        }
                    },
                    new ColumnDefinition{
                        Name = "locY",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.Integer,
                            Size = 11
                        }
                    },
                    new ColumnDefinition{
                        Name = "lastcheck",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.Integer,
                            Size = 10
                        }
                    },
                    new ColumnDefinition{
                        Name = "failcounter",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.Integer,
                            Size = 11
                        }
                    }
                }, new IndexDefinition[1]{
                    new IndexDefinition{
                        Fields = new string[2]{ "serverIP", "regionMapTexture" },
                        Type = IndexType.Unique
                    }
                }
            ));

            #endregion

            #region wi_sitemanagement

            schema.Add(new Rec<string, ColumnDefinition[], IndexDefinition[]>(
                "wi_sitemanagement",
                new ColumnDefinition[3]{
                    new ColumnDefinition{
                        Name = "pagecase",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 100
                        }
                    }, new ColumnDefinition{
                        Name = "type",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 100
                        }
                    }, new ColumnDefinition{
                        Name = "include",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 255
                        }
                    }
                }, new IndexDefinition[1]{
                    new IndexDefinition{
                        Fields = new string[1]{ "pagecase" },
                        Type = IndexType.Primary
                    }
                }
            ));

            #endregion

            #region wi_startscreen_infowindow

            schema.Add(new Rec<string, ColumnDefinition[], IndexDefinition[]>(
                "wi_startscreen_infowindow",
                new ColumnDefinition[5]{
                    new ColumnDefinition{
                        Name = "gridstatus",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 255
                        }
                    },
                    new ColumnDefinition{
                        Name = "active",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 30
                        }
                    },
                    new ColumnDefinition{
                        Name = "color",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 255
                        }
                    },
                    new ColumnDefinition{
                        Name = "title",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 255
                        }
                    },
                    new ColumnDefinition{
                        Name = "message",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.Text
                        }
                    }
                }, new IndexDefinition[0]
            ));

            #endregion

            #region wi_startscreen_news

            schema.Add(new Rec<string, ColumnDefinition[], IndexDefinition[]>(
                "wi_startscreen_news",
                new ColumnDefinition[5]{
                    new ColumnDefinition{
                        Name = "id",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.Integer,
                            Size = 11,
                            auto_increment = true
                        }
                    }, new ColumnDefinition{
                        Name = "title",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 255
                        }
                    }, new ColumnDefinition{
                        Name = "message",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.Text
                        }
                    }, new ColumnDefinition{
                        Name = "time",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.Integer,
                            Size = 10,
                            defaultValue = "0"
                        }
                    }, new ColumnDefinition{
                        Name = "user",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 255
                        }
                    }
                }, new IndexDefinition[1]{
                    new IndexDefinition{
                        Fields = new string[1]{ "id" },
                        Type = IndexType.Primary
                    }
                }
            ));

            #endregion

            #region wi_statistics

            schema.Add(new Rec<string, ColumnDefinition[], IndexDefinition[]>(
                "wi_statistics",
                new ColumnDefinition[5]{
                    new ColumnDefinition{
                        Name = "serverIP",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 64
                        }
                    },
                    new ColumnDefinition{
                        Name = "serverPort",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.Integer,
                            Size = 11
                        }
                    },
                    new ColumnDefinition{
                        Name = "version",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 255
                        }
                    },
                    new ColumnDefinition{
                        Name = "lastcheck",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.Integer,
                            Size = 10
                        }
                    },
                    new ColumnDefinition{
                        Name = "failcounter",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.Integer,
                            Size = 11
                        }
                    }
                }, new IndexDefinition[1]{
                    new IndexDefinition{
                        Fields = new string[2]{ "serverIP", "serverPort" },
                        Type = IndexType.Unique
                    }
                }
            ));

            #endregion

            #region wi_gallery

            schema.Add(new Rec<string, ColumnDefinition[], IndexDefinition[]>(
                "wi_gallery",
                new ColumnDefinition[5]{
                    new ColumnDefinition{
                        Name = "picture",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 64
                        }
                    },
                    new ColumnDefinition{
                        Name = "picturethumbnail",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 64
                        }
                    },
                    new ColumnDefinition{
                        Name = "description",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 255
                        }
                    },
                    new ColumnDefinition{
                        Name = "active",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.Integer,
                            Size = 1
                        }
                    },
                    new ColumnDefinition{
                        Name = "rank",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.Integer,
                            Size = 11
                        }
                    }
                }, new IndexDefinition[1]{
                    new IndexDefinition{
                        Fields = new string[1]{ "picture" },
                        Type = IndexType.Unique
                    }
                }
            ));

            #endregion

            #region wi_users

            schema.Add(new Rec<string, ColumnDefinition[], IndexDefinition[]>(
                "wi_users",
                new ColumnDefinition[14]{
                    new ColumnDefinition{
                        Name = "UUID",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 36,
                            defaultValue = ""
                        }
                    },
                    new ColumnDefinition{
                        Name = "username",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 32
                        }
                    },
                    new ColumnDefinition{
                        Name = "lastname",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 32
                        }
                    },
                    new ColumnDefinition{
                        Name = "passwordHash",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 32
                        }
                    },
                    new ColumnDefinition{
                        Name = "passwordSalt",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 32
                        }
                    },
                    new ColumnDefinition{
                        Name = "realname1",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 255
                        }
                    },
                    new ColumnDefinition{
                        Name = "realname2",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 255
                        }
                    },
                    new ColumnDefinition{
                        Name = "adress1",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 255
                        }
                    },
                    new ColumnDefinition{
                        Name = "zip1",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 255
                        }
                    },
                    new ColumnDefinition{
                        Name = "city1",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 255
                        }
                    },
                    new ColumnDefinition{
                        Name = "country1",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 255
                        }
                    },
                    new ColumnDefinition{
                        Name = "emailadress",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 255
                        }
                    },
                    new ColumnDefinition{
                        Name = "agentIP",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 255
                        }
                    },
                    new ColumnDefinition{
                        Name = "active",
                        Type = new ColumnTypeDef{
                            Type = ColumnType.String,
                            Size = 255,
                            defaultValue = "1"
                        }
                    }
                }, new IndexDefinition[2]{
                    new IndexDefinition{
                        Fields = new string[1]{ "UUID" },
                        Type = IndexType.Primary
                    },
                    new IndexDefinition{
                        Fields = new string[2]{ "username", "lastname"},
                        Type = IndexType.Unique
                    }
                }
            ));

            #endregion
        }

        protected override void DoCreateDefaults(IDataConnector genericData)
        {
            EnsureAllTablesInSchemaExist(genericData);
            Dictionary<string, Dictionary<string, object>> tableData = new Dictionary<string, Dictionary<string, object>>();
            Dictionary<string, List<object[]>> tableMultiData = new Dictionary<string, List<object[]>>();

            #region wi_adminmodules
            
            string table = "wi_adminmodules";
            tableData[table] = new Dictionary<string, object>();

            tableData[table]["id"] = "1";
            tableData[table]["displayTopPanelSlider"] = "1";
            tableData[table]["displayTemplateSelector"] = "1";
            tableData[table]["displayStyleSwitcher"] = "1";
            tableData[table]["displayStyleSizer"] = "1";
            tableData[table]["displayFontSizer"] = "1";
            tableData[table]["displayLanguageSelector"] = "1";
            tableData[table]["displayScrollingText"] = "1";
            tableData[table]["displayWelcomeMessage"] = "1";
            tableData[table]["displayLogo"] = "1";
            tableData[table]["displayLogoEffect"] = "1";
            tableData[table]["displaySlideShow"] = "1";
            tableData[table]["displayMegaMenu"] = "1";
            tableData[table]["displayDate"] = "1";
            tableData[table]["displayTime"] = "1";
            tableData[table]["displayRoundedCorner"] = "1";
            tableData[table]["displayBackgroundColorAnimation"] = "1";
            tableData[table]["displayPageLoadTime"] = "1";
            tableData[table]["displayW3c"] = "0";
            tableData[table]["displayRss"] = "1";

            #endregion

            #region wi_adminsettings

            table = "wi_adminsetting";
            tableData[table] = new Dictionary<string, object>();

            tableData[table]["startregion"] = "";
            tableData[table]["userdir"] = "";
            tableData[table]["griddir"] = "";
            tableData[table]["assetdir"] = "";
            tableData[table]["lastnames"] = "0";
            tableData[table]["adress"] = "0";
            tableData[table]["region"] = "0";
            tableData[table]["allowRegistrations"] = "1";
            tableData[table]["verifyUsers"] = "0";
            tableData[table]["ForceAge"] = 0;

            #endregion

            #region wi_country

            table = "wi_country";
            tableMultiData[table] = new List<object[]>();

            tableMultiData[table].Add(new object[1] { "Albania" });
            tableMultiData[table].Add(new object[1] { "Belgium" });
            tableMultiData[table].Add(new object[1] { "Bosnia" });
            tableMultiData[table].Add(new object[1] { "Bulgaria" });
            tableMultiData[table].Add(new object[1] { "Germany" });
            tableMultiData[table].Add(new object[1] { "Denmark" });
            tableMultiData[table].Add(new object[1] { "Estonia" });
            tableMultiData[table].Add(new object[1] { "Finland" });
            tableMultiData[table].Add(new object[1] { "France" });
            tableMultiData[table].Add(new object[1] { "Georgia" });
            tableMultiData[table].Add(new object[1] { "Greece" });
            tableMultiData[table].Add(new object[1] { "United Kingdom" });
            tableMultiData[table].Add(new object[1] { "Ireland" });
            tableMultiData[table].Add(new object[1] { "Iceland" });
            tableMultiData[table].Add(new object[1] { "Italy" });
            tableMultiData[table].Add(new object[1] { "Croatia" });
            tableMultiData[table].Add(new object[1] { "Latvia" });
            tableMultiData[table].Add(new object[1] { "Lithuania" });
            tableMultiData[table].Add(new object[1] { "Luxembourg" });
            tableMultiData[table].Add(new object[1] { "Malta" });
            tableMultiData[table].Add(new object[1] { "Macedonia" });
            tableMultiData[table].Add(new object[1] { "Moldova" });
            tableMultiData[table].Add(new object[1] { "Netherlands" });
            tableMultiData[table].Add(new object[1] { "Norway" });
            tableMultiData[table].Add(new object[1] { "Poland" });
            tableMultiData[table].Add(new object[1] { "Portugal" });
            tableMultiData[table].Add(new object[1] { "Romania" });
            tableMultiData[table].Add(new object[1] { "Russia" });
            tableMultiData[table].Add(new object[1] { "Sweden" });
            tableMultiData[table].Add(new object[1] { "Switzerland" });
            tableMultiData[table].Add(new object[1] { "Serbia & Montenegro" });
            tableMultiData[table].Add(new object[1] { "Slovakia" });
            tableMultiData[table].Add(new object[1] { "Slovenia" });
            tableMultiData[table].Add(new object[1] { "Espana" });
            tableMultiData[table].Add(new object[1] { "Czech Rep." });
            tableMultiData[table].Add(new object[1] { "Turkey" });
            tableMultiData[table].Add(new object[1] { "Ukraine" });
            tableMultiData[table].Add(new object[1] { "Hungary" });
            tableMultiData[table].Add(new object[1] { "Belarus" });
            tableMultiData[table].Add(new object[1] { "Cyprus" });
            tableMultiData[table].Add(new object[1] { "Austria" });
            tableMultiData[table].Add(new object[1] { "Afghanistan" });
            tableMultiData[table].Add(new object[1] { "Armenia" });
            tableMultiData[table].Add(new object[1] { "Azerbaijan" });
            tableMultiData[table].Add(new object[1] { "Bangladesh" });
            tableMultiData[table].Add(new object[1] { "Bhutan" });
            tableMultiData[table].Add(new object[1] { "Brunei" });
            tableMultiData[table].Add(new object[1] { "India" });
            tableMultiData[table].Add(new object[1] { "Indonesia" });
            tableMultiData[table].Add(new object[1] { "Japan" });
            tableMultiData[table].Add(new object[1] { "Cambodia" });
            tableMultiData[table].Add(new object[1] { "Kazakhstan" });
            tableMultiData[table].Add(new object[1] { "Kyrgyzstan" });
            tableMultiData[table].Add(new object[1] { "Laos" });
            tableMultiData[table].Add(new object[1] { "Malaysia" });
            tableMultiData[table].Add(new object[1] { "Maldives" });
            tableMultiData[table].Add(new object[1] { "Mongolia" });
            tableMultiData[table].Add(new object[1] { "Myanmar" });
            tableMultiData[table].Add(new object[1] { "Nepal" });
            tableMultiData[table].Add(new object[1] { "North Korea" });
            tableMultiData[table].Add(new object[1] { "Pakistan" });
            tableMultiData[table].Add(new object[1] { "Philippines" });
            tableMultiData[table].Add(new object[1] { "Singapore" });
            tableMultiData[table].Add(new object[1] { "Sri Lanka" });
            tableMultiData[table].Add(new object[1] { "South Korea" });
            tableMultiData[table].Add(new object[1] { "Tajikistan" });
            tableMultiData[table].Add(new object[1] { "Taiwan" });
            tableMultiData[table].Add(new object[1] { "Thailand" });
            tableMultiData[table].Add(new object[1] { "Turkmenistan" });
            tableMultiData[table].Add(new object[1] { "Uzbekistan" });
            tableMultiData[table].Add(new object[1] { "Viet Nam" });
            tableMultiData[table].Add(new object[1] { "Canada" });
            tableMultiData[table].Add(new object[1] { "Mexico" });
            tableMultiData[table].Add(new object[1] { "USA" });
            tableMultiData[table].Add(new object[1] { "Antigua und Barbuda" });
            tableMultiData[table].Add(new object[1] { "Aruba" });
            tableMultiData[table].Add(new object[1] { "Bahamas" });
            tableMultiData[table].Add(new object[1] { "Barbados" });
            tableMultiData[table].Add(new object[1] { "Belize" });
            tableMultiData[table].Add(new object[1] { "Bermuda" });
            tableMultiData[table].Add(new object[1] { "Cayman Islands" });
            tableMultiData[table].Add(new object[1] { "Costa Rica" });
            tableMultiData[table].Add(new object[1] { "Curacao" });
            tableMultiData[table].Add(new object[1] { "Dominica" });
            tableMultiData[table].Add(new object[1] { "Dominican Rep." });
            tableMultiData[table].Add(new object[1] { "El Salvador" });
            tableMultiData[table].Add(new object[1] { "Grenada" });
            tableMultiData[table].Add(new object[1] { "Guadeloupe" });
            tableMultiData[table].Add(new object[1] { "Guatemala" });
            tableMultiData[table].Add(new object[1] { "Haiti" });
            tableMultiData[table].Add(new object[1] { "Honduras" });
            tableMultiData[table].Add(new object[1] { "Jamaica" });
            tableMultiData[table].Add(new object[1] { "Virgin Islands" });
            tableMultiData[table].Add(new object[1] { "Cuba" });
            tableMultiData[table].Add(new object[1] { "Martinique" });
            tableMultiData[table].Add(new object[1] { "Nicaragua" });
            tableMultiData[table].Add(new object[1] { "Panama" });
            tableMultiData[table].Add(new object[1] { "Puerto Rico" });
            tableMultiData[table].Add(new object[1] { "St. Kitts und Nevis" });
            tableMultiData[table].Add(new object[1] { "St. Lucia" });
            tableMultiData[table].Add(new object[1] { "St. Maarten" });
            tableMultiData[table].Add(new object[1] { "St. Vincent & Grenadin" });
            tableMultiData[table].Add(new object[1] { "Trinidad & Tobago" });
            tableMultiData[table].Add(new object[1] { "Argentina" });
            tableMultiData[table].Add(new object[1] { "Bolivia" });
            tableMultiData[table].Add(new object[1] { "Brazil" });
            tableMultiData[table].Add(new object[1] { "Chile" });
            tableMultiData[table].Add(new object[1] { "Ecuador" });
            tableMultiData[table].Add(new object[1] { "Guyana" });
            tableMultiData[table].Add(new object[1] { "Colombia" });
            tableMultiData[table].Add(new object[1] { "Paraguay" });
            tableMultiData[table].Add(new object[1] { "Peru" });
            tableMultiData[table].Add(new object[1] { "Suriname" });
            tableMultiData[table].Add(new object[1] { "Uruguay" });
            tableMultiData[table].Add(new object[1] { "Venezuela" });
            tableMultiData[table].Add(new object[1] { "Australia" });
            tableMultiData[table].Add(new object[1] { "Fiji" });
            tableMultiData[table].Add(new object[1] { "Marshall Islands" });
            tableMultiData[table].Add(new object[1] { "Micronesia" });
            tableMultiData[table].Add(new object[1] { "Nauru" });
            tableMultiData[table].Add(new object[1] { "New Zealand" });
            tableMultiData[table].Add(new object[1] { "Palau" });
            tableMultiData[table].Add(new object[1] { "Papua New Guinea" });
            tableMultiData[table].Add(new object[1] { "Samoa" });
            tableMultiData[table].Add(new object[1] { "Tonga" });
            tableMultiData[table].Add(new object[1] { "Tuvalu" });
            tableMultiData[table].Add(new object[1] { "Vanuatu" });
            tableMultiData[table].Add(new object[1] { "Bahrain" });
            tableMultiData[table].Add(new object[1] { "Iraq" });
            tableMultiData[table].Add(new object[1] { "Iran" });
            tableMultiData[table].Add(new object[1] { "Israel" });
            tableMultiData[table].Add(new object[1] { "Yemen" });
            tableMultiData[table].Add(new object[1] { "Jordan" });
            tableMultiData[table].Add(new object[1] { "Quatar" });
            tableMultiData[table].Add(new object[1] { "Kuwait" });
            tableMultiData[table].Add(new object[1] { "Lebanon" });
            tableMultiData[table].Add(new object[1] { "Oman" });
            tableMultiData[table].Add(new object[1] { "Palestinian authority" });
            tableMultiData[table].Add(new object[1] { "Saudi Arabia" });
            tableMultiData[table].Add(new object[1] { "Syria" });
            tableMultiData[table].Add(new object[1] { "U.A.E." });
            tableMultiData[table].Add(new object[1] { "Algeria" });
            tableMultiData[table].Add(new object[1] { "Angola" });
            tableMultiData[table].Add(new object[1] { "Benin" });
            tableMultiData[table].Add(new object[1] { "Botswana" });
            tableMultiData[table].Add(new object[1] { "Burkina Faso" });
            tableMultiData[table].Add(new object[1] { "Burundi" });
            tableMultiData[table].Add(new object[1] { "Dem. Rep. of the Congo" });
            tableMultiData[table].Add(new object[1] { "Djibouti" });
            tableMultiData[table].Add(new object[1] { "Céte d''Ivoire" });
            tableMultiData[table].Add(new object[1] { "Eritrea" });
            tableMultiData[table].Add(new object[1] { "Gabun" });
            tableMultiData[table].Add(new object[1] { "Gambia" });
            tableMultiData[table].Add(new object[1] { "Ghana" });
            tableMultiData[table].Add(new object[1] { "Guinea" });
            tableMultiData[table].Add(new object[1] { "Guinea-Bissau" });
            tableMultiData[table].Add(new object[1] { "Cameroon" });
            tableMultiData[table].Add(new object[1] { "Cape Verde" });
            tableMultiData[table].Add(new object[1] { "Kenya" });
            tableMultiData[table].Add(new object[1] { "Lesotho" });
            tableMultiData[table].Add(new object[1] { "Liberia" });
            tableMultiData[table].Add(new object[1] { "Libya" });
            tableMultiData[table].Add(new object[1] { "Madagascar" });
            tableMultiData[table].Add(new object[1] { "Malawi" });
            tableMultiData[table].Add(new object[1] { "Mali" });
            tableMultiData[table].Add(new object[1] { "Morocco" });
            tableMultiData[table].Add(new object[1] { "Mauritania" });
            tableMultiData[table].Add(new object[1] { "Mauritius" });
            tableMultiData[table].Add(new object[1] { "Mozambique" });
            tableMultiData[table].Add(new object[1] { "Namibia" });
            tableMultiData[table].Add(new object[1] { "Niger" });
            tableMultiData[table].Add(new object[1] { "Nigeria" });
            tableMultiData[table].Add(new object[1] { "Dem. Rep. of the Congo" });
            tableMultiData[table].Add(new object[1] { "Zambia" });
            tableMultiData[table].Add(new object[1] { "Sao Tomé and Principe" });
            tableMultiData[table].Add(new object[1] { "Senegal" });
            tableMultiData[table].Add(new object[1] { "Seychelles" });
            tableMultiData[table].Add(new object[1] { "Sierra Leone" });
            tableMultiData[table].Add(new object[1] { "Simbabwe" });
            tableMultiData[table].Add(new object[1] { "Somalia" });
            tableMultiData[table].Add(new object[1] { "Sudan" });
            tableMultiData[table].Add(new object[1] { "Swaziland" });
            tableMultiData[table].Add(new object[1] { "South Africa" });
            tableMultiData[table].Add(new object[1] { "Tanzania" });
            tableMultiData[table].Add(new object[1] { "Togo" });
            tableMultiData[table].Add(new object[1] { "Chad" });
            tableMultiData[table].Add(new object[1] { "Tunisia" });
            tableMultiData[table].Add(new object[1] { "Uganda" });
            tableMultiData[table].Add(new object[1] { "Central African Rep." });
            tableMultiData[table].Add(new object[1] { "Egypt" });
            tableMultiData[table].Add(new object[1] { "Guinea Equatorial" });
            tableMultiData[table].Add(new object[1] { "Ethiopia" });
            tableMultiData[table].Add(new object[1] { "La Réunion" });
            tableMultiData[table].Add(new object[1] { "Solomon Islands" });
            tableMultiData[table].Add(new object[1] { "French Guiana" });

            #endregion

            #region wi_lastnames

            table = "wi_lastnames";
            tableMultiData[table] = new List<object[]>();

            tableMultiData[table].Add(new object[2] { "Binder", "1" });
            tableMultiData[table].Add(new object[2] { "Noel", "1" });
            tableMultiData[table].Add(new object[2] { "Young", "1" });
            tableMultiData[table].Add(new object[2] { "Roux", "1" });
            tableMultiData[table].Add(new object[2] { "Allen", "1" });
            tableMultiData[table].Add(new object[2] { "Heron", "1" });
            tableMultiData[table].Add(new object[2] { "Mansworld", "1" });
            tableMultiData[table].Add(new object[2] { "Babbi", "1" });
            tableMultiData[table].Add(new object[2] { "Crazys", "1" });
            tableMultiData[table].Add(new object[2] { "Linden", "1" });
            tableMultiData[table].Add(new object[2] { "Machlam", "1" });
            tableMultiData[table].Add(new object[2] { "Notringham", "1" });
            tableMultiData[table].Add(new object[2] { "Opus", "1" });
            tableMultiData[table].Add(new object[2] { "Hausermann", "1" });
            tableMultiData[table].Add(new object[2] { "McLachlan", "1" });
            tableMultiData[table].Add(new object[2] { "McKinsey", "1" });
            tableMultiData[table].Add(new object[2] { "Pohl", "1" });
            tableMultiData[table].Add(new object[2] { "Schwarzenegger", "1" });
            tableMultiData[table].Add(new object[2] { "Mueller", "1" });
            tableMultiData[table].Add(new object[2] { "Nosemann", "1" });
            tableMultiData[table].Add(new object[2] { "Obolus", "1" });
            tableMultiData[table].Add(new object[2] { "Himbaer", "1" });
            tableMultiData[table].Add(new object[2] { "Nala", "1" });
            tableMultiData[table].Add(new object[2] { "Kandee", "1" });
            tableMultiData[table].Add(new object[2] { "Bauer", "1" });
            tableMultiData[table].Add(new object[2] { "Simons", "1" });
            tableMultiData[table].Add(new object[2] { "Raptor", "1" });
            tableMultiData[table].Add(new object[2] { "Maek", "1" });
            tableMultiData[table].Add(new object[2] { "Huss", "1" });
            tableMultiData[table].Add(new object[2] { "Mondial", "1" });
            tableMultiData[table].Add(new object[2] { "Moondancer", "1" });
            tableMultiData[table].Add(new object[2] { "Sweetheart", "1" });
            tableMultiData[table].Add(new object[2] { "Schnuggy", "1" });
            tableMultiData[table].Add(new object[2] { "Swindlehurst", "1" });
            tableMultiData[table].Add(new object[2] { "Baumeister", "1" });
            tableMultiData[table].Add(new object[2] { "Bloomberg", "1" });
            tableMultiData[table].Add(new object[2] { "Dredd", "1" });
            tableMultiData[table].Add(new object[2] { "Gridlock", "1" });
            tableMultiData[table].Add(new object[2] { "Bohlen", "1" });
            tableMultiData[table].Add(new object[2] { "Snapper", "1" });
            tableMultiData[table].Add(new object[2] { "Tickle", "1" });
            tableMultiData[table].Add(new object[2] { "Ewing", "1" });
            tableMultiData[table].Add(new object[2] { "Schwinge", "1" });
            tableMultiData[table].Add(new object[2] { "Nonsito", "1" });

            #endregion

            #region wi_pagemanager

            table = "wi_pagemanager";
            tableMultiData[table] = new List<object[]>();

            tableMultiData[table].Add(new object[7] { "webui_menu_item_home", 1.0, "1", "index.php?page=home", "_self", "2", null });
            tableMultiData[table].Add(new object[7] { "webui_menu_item_adminhome", 2.0, "1", "index.php?page=adminhome", "_self", "3", null });
            tableMultiData[table].Add(new object[7] { "webui_menu_item_adminmanage", 2.1, "1", "index.php?page=adminmanage", "_self", "3", "webui_menu_item_adminhome" });
            tableMultiData[table].Add(new object[7] { "webui_menu_item_adminsettings", 2.2, "1", "index.php?page=adminsettings", "_self", "3", "webui_menu_item_adminhome" });
            tableMultiData[table].Add(new object[7] { "webui_menu_item_adminmodules", 2.3, "1", "index.php?page=adminmodules", "_self", "3", "webui_menu_item_adminhome" });
            tableMultiData[table].Add(new object[7] { "webui_menu_item_adminloginscreen", 2.4, "1", "index.php?page=adminloginscreen", "_self", "3", "webui_menu_item_adminhome" });
            tableMultiData[table].Add(new object[7] { "webui_menu_item_adminnewsmanager", 2.5, "1", "index.php?page=adminnewsmanager", "_self", "3", "webui_menu_item_adminhome" });
            tableMultiData[table].Add(new object[7] { "webui_menu_item_adminsupport", 2.6, "1", "index.php?page=adminsupport", "_self", "3", "webui_menu_item_adminhome" });
            tableMultiData[table].Add(new object[7] { "webui_menu_item_account", 3.0, "1", "index.php?page=account", "_self", "1", null });
            tableMultiData[table].Add(new object[7] { "webui_menu_item_changeaccount", 3.1, "1", "index.php?page=changeaccount", "_self", "1", "webui_menu_item_account" });
            tableMultiData[table].Add(new object[7] { "webui_menu_item_world", 4.0, "1", "index.php?page=world", "_self", "2", null });
            tableMultiData[table].Add(new object[7] { "webui_menu_item_news", 4.1, "1", "index.php?page=news", "_self", "2", "webui_menu_item_world" });
            tableMultiData[table].Add(new object[7] { "webui_menu_item_regions", 4.2, "1", "index.php?page=regionlist", "_self", "2", "webui_menu_item_world" });
            tableMultiData[table].Add(new object[7] { "webui_menu_item_worldmap", 4.3, "1", "index.php?page=worldmap", "_self", "2", "webui_menu_item_world" });
            tableMultiData[table].Add(new object[7] { "webui_menu_item_quickmap", 4.4, "1", "index.php?page=quickmap", "_self", "2", "webui_menu_item_world" });
            tableMultiData[table].Add(new object[7] { "webui_menu_item_gallery", 4.5, "1", "index.php?page=gallery", "_self", "2", "webui_menu_item_world" });
            tableMultiData[table].Add(new object[7] { "webui_menu_item_users", 5.0, "1", "index.php?page=users", "_self", "1", null });
            tableMultiData[table].Add(new object[7] { "webui_menu_item_peoplesearch", 5.1, "1", "index.php?page=peoplesearch", "_self", "1", "webui_menu_item_users" });
            tableMultiData[table].Add(new object[7] { "webui_menu_item_onlineusers", 5.2, "1", "index.php?page=onlineusers", "_self", "1", "webui_menu_item_users" });
            tableMultiData[table].Add(new object[7] { "webui_menu_item_register", 6.0, "1", "index.php?page=register", "_self", "0", null });
            tableMultiData[table].Add(new object[7] { "webui_menu_item_login", 7.0, "1", "index.php?page=login", "_self", "0", null });
            tableMultiData[table].Add(new object[7] { "webui_menu_item_forgotpass", 7.1, "1", "index.php?page=forgotpass", "_self", "0", "webui_menu_item_login" });
            tableMultiData[table].Add(new object[7] { "webui_menu_item_logout", 8.0, "1", "index.php?page=logout", "_self", "1", null });
            tableMultiData[table].Add(new object[7] { "webui_menu_item_help", 9.0, "1", "index.php?page=help", "_self", "2", null });
            tableMultiData[table].Add(new object[7] { "webui_menu_item_chat", 9.1, "1", "index.php?page=chat", "_self", "2", "webui_menu_item_help" });
            tableMultiData[table].Add(new object[7] { "webui_menu_item_downloads", 9.2, "1", "index.php?page=downloads", "_self", "2", "webui_menu_item_help" });
            tableMultiData[table].Add(new object[7] { "webui_menu_item_addgrid", 9.3, "1", "index.php?page=addgrid", "_self", "2", "webui_menu_item_help" });
            tableMultiData[table].Add(new object[7] { "webui_menu_item_addserver", 9.4, "1", "index.php?page=addserver", "_self", "2", "webui_menu_item_help" });

            #endregion

            #region wi_sitemanagement

            table = "wi_sitemanagement";
            tableMultiData[table] = new List<object[]>();

            tableMultiData[table].Add(new object[3] { "activate", "main", "activate.php" });
            tableMultiData[table].Add(new object[3] { "activatemail", "main", "activatemail.php" });
            tableMultiData[table].Add(new object[3] { "changeaccount", "account", "changeaccount.php" });
            tableMultiData[table].Add(new object[3] { "forgotpass", "account", "forgotpass.php" });
            tableMultiData[table].Add(new object[3] { "news", "news", "news.php" });
            tableMultiData[table].Add(new object[3] { "home", "main", "home.php" });
            tableMultiData[table].Add(new object[3] { "login", "main", "login.php" });
            tableMultiData[table].Add(new object[3] { "logout", "main", "logout.php" });
            tableMultiData[table].Add(new object[3] { "onlineusers", "main", "onlineusers.php" });
            tableMultiData[table].Add(new object[3] { "peoplesearch", "main", "peoplesearch.php" });
            tableMultiData[table].Add(new object[3] { "register", "account", "register.php" });
            tableMultiData[table].Add(new object[3] { "regionlist", "main", "regionlist.php" });
            tableMultiData[table].Add(new object[3] { "resetpass", "account", "resetpass.php" });
            tableMultiData[table].Add(new object[3] { "worldmap", "main", "worldmap.php" });
            tableMultiData[table].Add(new object[3] { "quickmap", "main", "quickmap.php" });
            tableMultiData[table].Add(new object[3] { "adminhome", "admin", "home.php" });
            tableMultiData[table].Add(new object[3] { "adminloginscreen", "admin", "loginscreenmanager.php" });
            tableMultiData[table].Add(new object[3] { "adminnewsmanager", "admin", "newsmanager.php" });
            tableMultiData[table].Add(new object[3] { "adminmanage", "admin", "manage.php" });
            tableMultiData[table].Add(new object[3] { "news_add", "admin", "news_add.php" });
            tableMultiData[table].Add(new object[3] { "news_edit", "admin", "news_edit.php" });
            tableMultiData[table].Add(new object[3] { "adminsettings", "admin", "settings.php" });
            tableMultiData[table].Add(new object[3] { "adminmodules", "admin", "modules.php" });
            tableMultiData[table].Add(new object[3] { "adminedit", "admin", "edit.php" });
            tableMultiData[table].Add(new object[3] { "account", "account", "main.php" });
            tableMultiData[table].Add(new object[3] { "world", "main", "worldmain.php" });
            tableMultiData[table].Add(new object[3] { "users", "main", "usersmain.php" });
            tableMultiData[table].Add(new object[3] { "help", "main", "help.php" });
            tableMultiData[table].Add(new object[3] { "chat", "main", "chat.php" });
            tableMultiData[table].Add(new object[3] { "downloads", "main", "downloads.php" });
            tableMultiData[table].Add(new object[3] { "addgrid", "main", "addgrid.php" });
            tableMultiData[table].Add(new object[3] { "addserver", "main", "addserver.php" });
            tableMultiData[table].Add(new object[3] { "gallery", "main", "gallery.php" });
            tableMultiData[table].Add(new object[3] { "adminsupport", "admin", "support.php" });

            #endregion

            #region wi_startscreen_infowindow

            table = "wi_startscreen_infowindow";
            tableData[table] = new Dictionary<string, object>();

            tableData[table]["gridstatus"] = "1";
            tableData[table]["active"] = "1";
            tableData[table]["color"] = "yellow";
            tableData[table]["title"] = "Info system Works very well ;-)";
            tableData[table]["message"] = "Today we've built a new loginscreen info system and it works very well. You can now see Info windows on the startup screen.";

            #endregion

            #region wi_startscreen_news

            table = "wi_startscreen_news";
            tableData[table] = new Dictionary<string, object>();

            tableData[table]["title"] = "[COMPLETE] The new loginscreen is done and works fine so far";
            tableData[table]["message"] = "<p>We built a new loginscreen which will inform you about Grid updates or changes. Also you can now see how many users and regions are online, and more.  Also, you may from time to time see an infowindow, which informs you about important news.  Have Fun !</p>";
            tableData[table]["time"] = 1211321439;
            tableData[table]["user"] = "Grid News";

            #endregion

            #region wi_gallery

            table = "wi_gallery";
            tableMultiData[table] = new List<object[]>();

            tableMultiData[table].Add(new object[5] { "login1.jpg", "image1thumbnail.jpg", "Image 1 of our world", "1", "1" });
            tableMultiData[table].Add(new object[5] { "login2.jpg", "image2thumbnail.jpg", "Image 2 of our world", "1", "1" });
            tableMultiData[table].Add(new object[5] { "login3.jpg", "image3thumbnail.jpg", "Image 3 of our world", "1", "1" });
            tableMultiData[table].Add(new object[5] { "login4.jpg", "image4thumbnail.jpg", "Image 4 of our world", "1", "1" });
            tableMultiData[table].Add(new object[5] { "login5.jpg", "image5thumbnail.jpg", "Image 5 of our world", "1", "1" });

            #endregion

            foreach (string tableName in tableData.Keys)
            {
                if (!genericData.TableExists(tableName))
                {
                    MainConsole.Instance.Debug(tableName + " does not exist");
                    return;
                }
            }
            foreach (string tableName in tableMultiData.Keys)
            {
                if (!genericData.TableExists(tableName))
                {
                    MainConsole.Instance.Debug(tableName + " does not exist");
                    return;
                }
            }

            foreach (System.Collections.Generic.KeyValuePair<string, Dictionary<string, object>> tableDataInsert in tableData)
            {
                genericData.Insert(tableDataInsert.Key, tableDataInsert.Value);
            }
            foreach (System.Collections.Generic.KeyValuePair<string, List<object[]>> tableMultiDataInsert in tableMultiData)
            {
                foreach (object[] rows in tableMultiDataInsert.Value)
                {
                    genericData.Insert(tableMultiDataInsert.Key, rows);
                }
            }
        }

        protected override bool DoValidate(IDataConnector genericData)
        {
            return TestThatAllTablesValidate(genericData);
        }

        protected override void DoMigrate(IDataConnector genericData)
        {
            DoCreateDefaults(genericData);
        }

        protected override void DoPrepareRestorePoint(IDataConnector genericData)
        {
            CopyAllTablesToTempVersions(genericData);
        }

        public override void FinishedMigration(IDataConnector genericData)
        {
        }
    }
}