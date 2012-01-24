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
            MigrationName = "WebUI";

            schema = new List<Rec<string, ColumnDefinition[], IndexDefinition[]>>(6);

            #region wi_adminmodules

            schema.Add(new Rec<string, ColumnDefinition[], IndexDefinition[]>(
                "wi_adminmodules",
                new ColumnDefinition[20]{
                    new ColumnDefinition{
                        Name = "id",
                        Type = ColumnTypes.Integer11
                    },
                    new ColumnDefinition{
                        Name = "displayTopPanelSlider",
                        Type = ColumnTypes.String10
                    },
                    new ColumnDefinition{
                        Name = "displayTemplateSelector",
                        Type = ColumnTypes.String10
                    },
                    new ColumnDefinition{
                        Name = "displayStyleSwitcher",
                        Type = ColumnTypes.String10
                    },
                    new ColumnDefinition{
                        Name = "displayStyleSizer",
                        Type = ColumnTypes.String10
                    },
                    new ColumnDefinition{
                        Name = "displayFontSizer",
                        Type = ColumnTypes.String10
                    },
                    new ColumnDefinition{
                        Name = "displayLanguageSelector",
                        Type = ColumnTypes.String10
                    },
                    new ColumnDefinition{
                        Name = "displayScrollingText",
                        Type = ColumnTypes.String10
                    },
                    new ColumnDefinition{
                        Name = "displayWelcomeMessage",
                        Type = ColumnTypes.String10
                    },
                    new ColumnDefinition{
                        Name = "displayLogo",
                        Type = ColumnTypes.String10
                    },
                    new ColumnDefinition{
                        Name = "displayLogoEffect",
                        Type = ColumnTypes.String10
                    },
                    new ColumnDefinition{
                        Name = "displaySlideShow",
                        Type = ColumnTypes.String10
                    },
                    new ColumnDefinition{
                        Name = "displayMegaMenu",
                        Type = ColumnTypes.String10
                    },
                    new ColumnDefinition{
                        Name = "displayDate",
                        Type = ColumnTypes.String10
                    },
                    new ColumnDefinition{
                        Name = "displayTime",
                        Type = ColumnTypes.String10
                    },
                    new ColumnDefinition{
                        Name = "displayRoundedCorner",
                        Type = ColumnTypes.String10
                    },
                    new ColumnDefinition{
                        Name = "displayBackgroundColorAnimation",
                        Type = ColumnTypes.String10
                    },
                    new ColumnDefinition{
                        Name = "displayPageLoadTime",
                        Type = ColumnTypes.String10
                    },
                    new ColumnDefinition{
                        Name = "displayW3c",
                        Type = ColumnTypes.String10
                    },
                    new ColumnDefinition{
                        Name = "displayRss",
                        Type = ColumnTypes.String10
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
                        Type = ColumnTypes.Integer11
                    },
                    new ColumnDefinition{
                        Name = "startregion",
                        Type = ColumnTypes.String255
                    },
                    new ColumnDefinition{
                        Name = "userdir",
                        Type = ColumnTypes.String255
                    },
                    new ColumnDefinition{
                        Name = "griddir",
                        Type = ColumnTypes.String255
                    },
                    new ColumnDefinition{
                        Name = "assetdir",
                        Type = ColumnTypes.String255
                    },
                    new ColumnDefinition{
                        Name = "lastnames",
                        Type = ColumnTypes.String10
                    },
                    new ColumnDefinition{
                        Name = "adress",
                        Type = ColumnTypes.String32
                    },
                    new ColumnDefinition{
                        Name = "region",
                        Type = ColumnTypes.Text
                    },
                    new ColumnDefinition{
                        Name = "allowRegistrations",
                        Type = ColumnTypes.String10
                    },
                    new ColumnDefinition{
                        Name = "verifyUsers",
                        Type = ColumnTypes.String10
                    },
                    new ColumnDefinition{
                        Name = "ForceAge",
                        Type = ColumnTypes.TinyInt1
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
                        Type = ColumnTypes.String36
                    },
                    new ColumnDefinition{
                        Name = "Picture",
                        Type = ColumnTypes.String32
                    },
                    new ColumnDefinition{
                        Name = "ArchiveName",
                        Type = ColumnTypes.String32
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
                        Type = ColumnTypes.String36
                    },
                    new ColumnDefinition{
                        Name = "agentIP",
                        Type = ColumnTypes.String255
                    },
                    new ColumnDefinition{
                        Name = "time",
                        Type = ColumnTypes.String255
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
                        Type = ColumnTypes.String36
                    }, new ColumnDefinition{
                        Name = "code",
                        Type = ColumnTypes.String255
                    }, new ColumnDefinition{
                        Name = "info",
                        Type = ColumnTypes.String255
                    }, new ColumnDefinition{
                        Name = "email",
                        Type = ColumnTypes.String255
                    }, new ColumnDefinition{
                        Name = "time",
                        Type = ColumnTypes.String255
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
                        Type = ColumnTypes.String100
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
                        Type = ColumnTypes.String255
                    }, new ColumnDefinition{
                        Name = "rank",
                        Type = ColumnTypes.Float
                    }, new ColumnDefinition{
                        Name = "active",
                        Type = ColumnTypes.String30
                    }, new ColumnDefinition{
                        Name = "url",
                        Type = ColumnTypes.Text
                    }, new ColumnDefinition{
                        Name = "target",
                        Type = ColumnTypes.String255
                    }, new ColumnDefinition{
                        Name = "display",
                        Type = ColumnTypes.String255
                    }, new ColumnDefinition{
                        Name = "parent",
                        Type = ColumnTypes.String255
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
                        Type = ColumnTypes.String64
                    },
                    new ColumnDefinition{
                        Name = "serverPort",
                        Type = ColumnTypes.Integer11
                    },
                    new ColumnDefinition{
                        Name = "regionMapTexture",
                        Type = ColumnTypes.String255
                    },
                    new ColumnDefinition{
                        Name = "locX",
                        Type = ColumnTypes.Integer11
                    },
                    new ColumnDefinition{
                        Name = "locY",
                        Type = ColumnTypes.Integer11
                    },
                    new ColumnDefinition{
                        Name = "lastcheck",
                        Type = ColumnTypes.Integer11
                    },
                    new ColumnDefinition{
                        Name = "failcounter",
                        Type = ColumnTypes.Integer11
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
                        Type = ColumnTypes.String100
                    }, new ColumnDefinition{
                        Name = "type",
                        Type = ColumnTypes.String100
                    }, new ColumnDefinition{
                        Name = "include",
                        Type = ColumnTypes.String255
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
                        Type = ColumnTypes.String255
                    },
                    new ColumnDefinition{
                        Name = "active",
                        Type = ColumnTypes.String30
                    },
                    new ColumnDefinition{
                        Name = "color",
                        Type = ColumnTypes.String255
                    },
                    new ColumnDefinition{
                        Name = "title",
                        Type = ColumnTypes.String255
                    },
                    new ColumnDefinition{
                        Name = "message",
                        Type = ColumnTypes.Text
                    }
                }, new IndexDefinition[0]
            ));

            #endregion

            #region wi_startscreen_news

            schema.Add(new Rec<string,ColumnDefinition[],IndexDefinition[]>(
                "wi_startscreen_news",
                new ColumnDefinition[5]{
                    new ColumnDefinition{
                        Name = "id",
                        Type = ColumnTypes.Integer11
                    }, new ColumnDefinition{
                        Name = "title",
                        Type = ColumnTypes.String255
                    }, new ColumnDefinition{
                        Name = "message",
                        Type = ColumnTypes.Text
                    }, new ColumnDefinition{
                        Name = "time",
                        Type = ColumnTypes.Integer11
                    }, new ColumnDefinition{
                        Name = "user",
                        Type = ColumnTypes.String255
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
                        Type = ColumnTypes.String64
                    },
                    new ColumnDefinition{
                        Name = "serverPort",
                        Type = ColumnTypes.Integer11
                    },
                    new ColumnDefinition{
                        Name = "version",
                        Type = ColumnTypes.String255
                    },
                    new ColumnDefinition{
                        Name = "lastcheck",
                        Type = ColumnTypes.Integer11
                    },
                    new ColumnDefinition{
                        Name = "failcounter",
                        Type = ColumnTypes.Integer11
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
                        Type = ColumnTypes.String64
                    },
                    new ColumnDefinition{
                        Name = "picturethumbnail",
                        Type = ColumnTypes.String64
                    },
                    new ColumnDefinition{
                        Name = "description",
                        Type = ColumnTypes.String255
                    },
                    new ColumnDefinition{
                        Name = "active",
                        Type = ColumnTypes.TinyInt1
                    },
                    new ColumnDefinition{
                        Name = "rank",
                        Type = ColumnTypes.Integer11
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
                        Type = ColumnTypes.String36
                    },
                    new ColumnDefinition{
                        Name = "username",
                        Type = ColumnTypes.String32
                    },
                    new ColumnDefinition{
                        Name = "lastname",
                        Type = ColumnTypes.String32
                    },
                    new ColumnDefinition{
                        Name = "passwordHash",
                        Type = ColumnTypes.String32
                    },
                    new ColumnDefinition{
                        Name = "passwordSalt",
                        Type = ColumnTypes.String32
                    },
                    new ColumnDefinition{
                        Name = "realname1",
                        Type = ColumnTypes.String255
                    },
                    new ColumnDefinition{
                        Name = "realname2",
                        Type = ColumnTypes.String255
                    },
                    new ColumnDefinition{
                        Name = "adress1",
                        Type = ColumnTypes.String255
                    },
                    new ColumnDefinition{
                        Name = "zip1",
                        Type = ColumnTypes.String255
                    },
                    new ColumnDefinition{
                        Name = "city1",
                        Type = ColumnTypes.String255
                    },
                    new ColumnDefinition{
                        Name = "country1",
                        Type = ColumnTypes.String255
                    },
                    new ColumnDefinition{
                        Name = "emailadress",
                        Type = ColumnTypes.String255
                    },
                    new ColumnDefinition{
                        Name = "agentIP",
                        Type = ColumnTypes.String255
                    },
                    new ColumnDefinition{
                        Name = "active",
                        Type = ColumnTypes.String255
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
    }
}