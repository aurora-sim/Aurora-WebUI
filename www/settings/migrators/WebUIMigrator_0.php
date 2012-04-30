<?php
/**
*	This file is based on c# code from the Aurora-Sim-Optional-Modules project.
*	As such, the original header text is included.
*/

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


namespace Aurora\Addon\WebUI\Migrators{

	use Aurora\DataManager\Migration\Migrator;
	use Aurora\DataManager\Migration\Migrator\Schema;

	use Aurora\Framework\IDataConnector;

	use Aurora\Framework\ColumnType;
	use Aurora\Framework\ColumnDefinition;
	use Aurora\Framework\ColumnDefinition\Iterator as ColDefs;

	use Aurora\Framework\IndexType;
	use Aurora\Framework\IndexDefinition;
	use Aurora\Framework\IndexDefinition\Iterator as IndexDefs;


	class WebUI_0 extends Migrator{


		const MigrationName = 'Wiredux';


		const BreakingChanges = 'wi_adminmodules wi_adminsetting wi_appearance wi_banned wi_codetable wi_country wi_gallery wi_lastnames wi_pagemanager wi_regions wi_sitemanagement wi_startscreen_infowindow wi_startscreen_news wi_statistics wi_users';


		protected function __construct(){
			parent::__construct(); // argumenut validation

			#region wi_adminmodules

			$this->schema[] = new Schema(
				'wi_adminmodules',
				new ColDefs(
					new ColumnDefinition('id', array(
						'Type'           => ColumnType::Integer,
						'Size'           => 11,
						'auto_increment' => true
					)),
					new ColumnDefinition('displayTopPanelSlider', array(
						'Type'           => ColumnType::String,
						'Size'           => 10
					)),
					new ColumnDefinition('displayTemplateSelector', array(
						'Type'           => ColumnType::String,
						'Size'           => 10
					)),
					new ColumnDefinition('displayStyleSwitcher', array(
						'Type'           => ColumnType::String,
						'Size'           => 10
					)),
					new ColumnDefinition('displayStyleSizer', array(
						'Type'           => ColumnType::String,
						'Size'           => 10
					)),
					new ColumnDefinition('displayFontSizer', array(
						'Type'           => ColumnType::String,
						'Size'           => 10
					)),
					new ColumnDefinition('displayLanguageSelector', array(
						'Type'           => ColumnType::String,
						'Size'           => 10
					)),
					new ColumnDefinition('displayScrollingText', array(
						'Type'           => ColumnType::String,
						'Size'           => 10
					)),
					new ColumnDefinition('displayWelcomeMessage', array(
						'Type'           => ColumnType::String,
						'Size'           => 10
					)),
					new ColumnDefinition('displayLogo', array(
						'Type'           => ColumnType::String,
						'Size'           => 10
					)),
					new ColumnDefinition('displayLogoEffect', array(
						'Type'           => ColumnType::String,
						'Size'           => 10
					)),
					new ColumnDefinition('displaySlideShow', array(
						'Type'           => ColumnType::String,
						'Size'           => 10
					)),
					new ColumnDefinition('displayMegaMenu', array(
						'Type'           => ColumnType::String,
						'Size'           => 10
					)),
					new ColumnDefinition('displayDate', array(
						'Type'           => ColumnType::String,
						'Size'           => 10
					)),
					new ColumnDefinition('displayTime', array(
						'Type'           => ColumnType::String,
						'Size'           => 10
					)),
					new ColumnDefinition('displayRoundedCorner', array(
						'Type'           => ColumnType::String,
						'Size'           => 10
					)),
					new ColumnDefinition('displayBackgroundColorAnimation', array(
						'Type'           => ColumnType::String,
						'Size'           => 10
					)),
					new ColumnDefinition('displayPageLoadTime', array(
						'Type'           => ColumnType::String,
						'Size'           => 10
					)),
					new ColumnDefinition('displayW3c', array(
						'Type'           => ColumnType::String,
						'Size'           => 10
					)),
					new ColumnDefinition('displayRss', array(
						'Type'           => ColumnType::String,
						'Size'           => 10
					))
				),
				new IndexDefs(
					new IndexDefinition(array('id'), IndexType::Primary)
				)
			);

			#endregion

			#region wi_adminsettings

			$this->schema[] = new Schema(
				'wi_adminsetting',
				new ColDefs(
					new ColumnDefinition('id', array(
						'Type'           => ColumnType::Integer,
						'Size'           => 11,
						'auto_increment' => true
					)),
					new ColumnDefinition('startregion', array(
						'Type'           => ColumnType::String,
						'Size'           => 255
					)),
					new ColumnDefinition('userdir', array(
						'Type'           => ColumnType::String,
						'Size'           => 255
					)),
					new ColumnDefinition('griddir', array(
						'Type'           => ColumnType::String,
						'Size'           => 255
					)),
					new ColumnDefinition('assetdir', array(
						'Type'           => ColumnType::String,
						'Size'           => 255
					)),
					new ColumnDefinition('lastnames', array(
						'Type'           => ColumnType::String,
						'Size'           => 10
					)),
					new ColumnDefinition('adress', array(
						'Type'           => ColumnType::String,
						'Size'           => 32
					)),
					new ColumnDefinition('region', array(
						'Type'           => ColumnType::Text
					)),
					new ColumnDefinition('allowRegistrations', array(
						'Type'           => ColumnType::String,
						'Size'           => 10
					)),
					new ColumnDefinition('verifyUsers', array(
						'Type'           => ColumnType::String,
						'Size'           => 10
					)),
					new ColumnDefinition('ForceAge', array(
						'Type'           => ColumnType::Integer,
						'Size'           => 11
					))
				),
				new IndexDefs(
					new IndexDefinition(array('id'), IndexType::Primary)
				)
			);

			#endregion

			#region wi_appearance

			$this->schema[] = new Schema('wi_appearance', new ColDefs(
				new ColumnDefinition('Enabled', array(
					'Type'         => ColumnType::String,
					'Size'         => 36,
					'defaultValue' => ''
				)),
				new ColumnDefinition('Picture', array(
					'Type'         => ColumnType::String,
					'Size'         => 32
				)),
				new ColumnDefinition('ArchiveName', array(
					'Type'         => ColumnType::String,
					'Size'         => 32
				))
			), new IndexDefs(
				new IndexDefinition(array('ArchiveName'), IndexType::Primary)
			));

			#endregion

			#region wi_banned

			$this->schema[] = new Schema('wi_banned', new ColDefs(
				new ColumnDefinition('UUID', array(
					'Type' => ColumnType::String,
					'Size' => 36
				)),
				new ColumnDefinition('agentIP', array(
					'Type' => ColumnType::String,
					'Size' => 255
				)),
				new ColumnDefinition('time', array(
					'Type' => ColumnType::String,
					'Size' => 255
				))
			), new IndexDefs(

			));

			#endregion

			#region wi_codetable

			$this->schema[] = new Schema('wi_codetable', new ColDefs(
				new ColumnDefinition('UUID', array(
					'Type' => ColumnType::String,
					'Size' => 36
				)),
				new ColumnDefinition('code', array(
					'Type' => ColumnType::String,
					'Size' => 255
				)),
				new ColumnDefinition('info', array(
					'Type' => ColumnType::String,
					'Size' => 255
				)),
				new ColumnDefinition('email', array(
					'Type' => ColumnType::String,
					'Size' => 255
				)),
				new ColumnDefinition('time', array(
					'Type' => ColumnType::String,
					'Size' => 255
				))
			), new IndexDefs(

			));

			#endregion

			#region wi_country

			$this->schema[] = new Schema('wi_country', new ColDefs(
				new ColumnDefinition('name', array(
					'Type' => ColumnType::String,
					'Size' => 100
				))
			), new IndexDefs(

			));

			#endregion

			#region wi_lastnames

			$this->schema[] = new Schema('wi_lastnames', new ColDefs(
				new ColumnDefinition('name', array(
					'Type'         => ColumnType::String,
					'Size'         => 255
				)),
				new ColumnDefinition('active', array(
					'Type'         => ColumnType::String,
					'Size'         => 255,
					'defaultValue' => '1'
				))
			), new IndexDefs(

			));

			#endregion

			#region wi_pagemanager

			$this->schema[] = new Schema('wi_pagemanager', new ColDefs(
				new ColumnDefinition('id', array(
					'Type'         => ColumnType::String,
					'Size'         => 255
				)),
				new ColumnDefinition('rank', array(
					'Type'         => ColumnType::Float
				)),
				new ColumnDefinition('active', array(
					'Type'         => ColumnType::String,
					'Size'         => 30
				)),
				new ColumnDefinition('url', array(
					'Type'         => ColumnType::Text
				)),
				new ColumnDefinition('target', array(
					'Type'         => ColumnType::String,
					'Size'         => 255
				)),
				new ColumnDefinition('display', array(
					'Type'         => ColumnType::String,
					'Size'         => 255
				)),
				new ColumnDefinition('parent', array(
					'Type'         => ColumnType::String,
					'Size'         => 255,
					'isNull'       => true,
					'defaultValue' => 'NULL'
				))
			), new IndexDefs(
				new IndexDefinition(array('id'), IndexType::Primary)
			));

			#endregion

			#region wi_regions

			$this->schema[] = new Schema('wi_regions', new ColDefs(
				new ColumnDefinition('serverIP', array(
					'Type' => ColumnType::String,
					'Size' => 64
				)),
				new ColumnDefinition('serverPort', array(
					'Type' => ColumnType::Integer,
					'Size' => 11
				)),
				new ColumnDefinition('regionMapTexture', array(
					'Type' => ColumnType::String,
					'Size' => 255
				)),
				new ColumnDefinition('locX', array(
					'Type' => ColumnType::Integer,
					'Size' => 11
				)),
				new ColumnDefinition('locY', array(
					'Type' => ColumnType::Integer,
					'Size' => 11
				)),
				new ColumnDefinition('lastcheck', array(
					'Type' => ColumnType::Integer,
					'Size' => 10
				)),
				new ColumnDefinition('failcounter', array(
					'Type' => ColumnType::Integer,
					'Size' => 11
				))
			), new IndexDefs(
				new IndexDefinition(array( 'serverIP', 'regionMapTexture' ), IndexType::Unique)
			));

			#endregion

			#region wi_sitemanagement

			$this->schema[] = new Schema('wi_sitemanagement', new ColDefs(
				new ColumnDefinition('pagecase', array(
					'Type' => ColumnType::String,
					'Size' => 100
				)),
				new ColumnDefinition('type', array(
					'Type' => ColumnType::String,
					'Size' => 100
				)),
				new ColumnDefinition('include', array(
					'Type' => ColumnType::String,
					'Size' => 255
				))
			), new IndexDefs(
				new IndexDefinition(array( 'pagecase' ), IndexType::Primary)
			));

			#endregion

			#region wi_startscreen_infowindow

			$this->schema[] = new Schema('wi_startscreen_infowindow', new ColDefs(
				new ColumnDefinition('gridstatus', array(
					'Type' => ColumnType::String,
					'Size' => 255
				)),
				new ColumnDefinition('active', array(
					'Type' => ColumnType::String,
					'Size' => 30
				)),
				new ColumnDefinition('color', array(
					'Type' => ColumnType::String,
					'Size' => 255
				)),
				new ColumnDefinition('title', array(
					'Type' => ColumnType::String,
					'Size' => 255
				)),
				new ColumnDefinition('message', array(
					'Type' => ColumnType::Text
				))
			), new IndexDefs(

			));

			#endregion

			#region wi_startscreen_news

			$this->schema[] = new Schema('wi_startscreen_news', new ColDefs(
				new ColumnDefinition('id', array(
					'Type'           => ColumnType::Integer,
					'Size'           => 11,
					'auto_increment' => true
				)),
				new ColumnDefinition('title', array(
					'Type'           => ColumnType::String,
					'Size'           => 255
				)),
				new ColumnDefinition('message', array(
					'Type'           => ColumnType::Text
				)),
				new ColumnDefinition('time', array(
					'Type'           => ColumnType::Integer,
					'Size'           => 10,
					'defaultValue'   => '0'
				)),
				new ColumnDefinition('user', array(
					'Type'           => ColumnType::String,
					'Size'           => 255
				))
			), new IndexDefs(
				new IndexDefinition(array( 'id' ), IndexType::Primary)
			));

			#endregion

			#region wi_statistics

			$this->schema[] = new Schema('wi_statistics', new ColDefs(
				new ColumnDefinition('serverIP', array(
					'Type' => ColumnType::String,
					'Size' => 64
				)),
				new ColumnDefinition('serverPort', array(
					'Type' => ColumnType::Integer,
					'Size' => 11
				)),
				new ColumnDefinition('version', array(
					'Type' => ColumnType::String,
					'Size' => 255
				)),
				new ColumnDefinition('lastcheck', array(
					'Type' => ColumnType::Integer,
					'Size' => 10
				)),
				new ColumnDefinition('failcounter', array(
					'Type' => ColumnType::Integer,
					'Size' => 11
				))
			), new IndexDefs(
				new IndexDefinition(array( 'serverIP', 'serverPort' ), IndexType::Unique)
			));

			#endregion

			#region wi_gallery

			$this->schema[] = new Schema('wi_gallery', new ColDefs(
				new ColumnDefinition('picture', array(
					'Type' => ColumnType::String,
					'Size' => 64
				)),
				new ColumnDefinition('picturethumbnail', array(
					'Type' => ColumnType::String,
					'Size' => 64
				)),
				new ColumnDefinition('description', array(
					'Type' => ColumnType::String,
					'Size' => 255
				)),
				new ColumnDefinition('active', array(
					'Type' => ColumnType::Integer,
					'Size' => 1
				)),
				new ColumnDefinition('rank', array(
					'Type' => ColumnType::Integer,
					'Size' => 11
				))
			), new IndexDefs(
				new IndexDefinition(array( 'picture' ), IndexType::Unique)
			));

			#endregion

			#region wi_users

			$this->schema[] = new Schema('wi_users', new ColDefs(
				new ColumnDefinition('UUID', array(
					'Type'         => ColumnType::String,
					'Size'         => 36,
					'defaultValue' => ''
				)),
				new ColumnDefinition('username', array(
					'Type'         => ColumnType::String,
					'Size'         => 32
				)),
				new ColumnDefinition('lastname', array(
					'Type'         => ColumnType::String,
					'Size'         => 32
				)),
				new ColumnDefinition('passwordHash', array(
					'Type'         => ColumnType::String,
					'Size'         => 32
				)),
				new ColumnDefinition('passwordSalt', array(
					'Type'         => ColumnType::String,
					'Size'         => 32
				)),
				new ColumnDefinition('realname1', array(
					'Type'         => ColumnType::String,
					'Size'         => 255
				)),
				new ColumnDefinition('realname2', array(
					'Type'         => ColumnType::String,
					'Size'         => 255
				)),
				new ColumnDefinition('zip1', array(
					'Type'         => ColumnType::String,
					'Size'         => 255
				)),
				new ColumnDefinition('city1', array(
					'Type'         => ColumnType::String,
					'Size'         => 255
				)),
				new ColumnDefinition('country1', array(
					'Type'         => ColumnType::String,
					'Size'         => 255
				)),
				new ColumnDefinition('emailadress', array(
					'Type'         => ColumnType::String,
					'Size'         => 255
				)),
				new ColumnDefinition('agentIP', array(
					'Type'         => ColumnType::String,
					'Size'         => 255
				)),
				new ColumnDefinition('active', array(
					'Type'         => ColumnType::String,
					'Size'         => 255,
					'defaultValue' => '1'
				))
			), new IndexDefs(
				new IndexDefinition(array( 'UUID' ), IndexType::Primary),
				new IndexDefinition(array( 'username', 'lastname' ), IndexType::Unique)
			));

			#endregion
		}


		protected function DoCreateDefaults(IDataConnector $genericData){

			$this->EnsureAllTablesInSchemaExist($genericData);

			$tableData      = array();
			$tableMultiData = array();

			#region wi_adminmodules

			$tableData['wi_adminmodules'] = array(
				'id'                              => '1',
				'displayTopPanelSlider'           => '1',
				'displayTemplateSelector'         => '1',
				'displayStyleSwitcher'            => '1',
				'displayStyleSizer'               => '1',
				'displayFontSizer'                => '1',
				'displayLanguageSelector'         => '1',
				'displayScrollingText'            => '1',
				'displayWelcomeMessage'           => '1',
				'displayLogo'                     => '1',
				'displayLogoEffect'               => '1',
				'displaySlideShow'                => '1',
				'displayMegaMenu'                 => '1',
				'displayDate'                     => '1',
				'displayTime'                     => '1',
				'displayRoundedCorner'            => '1',
				'displayBackgroundColorAnimation' => '1',
				'displayPageLoadTime'             => '1',
				'displayW3c'                      => '0',
				'displayRss'                      => '1',
			);

			#endregion

			#region wi_adminsettings

			$tableData['wi_adminsetting'] = array(
				'startregion'        => '',
				'userdir'            => '',
				'griddir'            => '',
				'assetdir'           => '',
				'lastnames'          => '0',
				'adress'             => '0',
				'region'             => '0',
				'allowRegistrations' => '1',
				'verifyUsers'        => '0',
				'ForceAge'           => 0
			);

			#endregion

			#region wi_country

			$tableMultiData['wi_country'] = array(
				array('Albania'),
				array('Belgium'),
				array('Bosnia'),
				array('Bulgaria'),
				array('Germany'),
				array('Denmark'),
				array('Estonia'),
				array('Finland'),
				array('France'),
				array('Georgia'),
				array('Greece'),
				array('United Kingdom'),
				array('Ireland'),
				array('Iceland'),
				array('Italy'),
				array('Croatia'),
				array('Latvia'),
				array('Lithuania'),
				array('Luxembourg'),
				array('Malta'),
				array('Macedonia'),
				array('Moldova'),
				array('Netherlands'),
				array('Norway'),
				array('Poland'),
				array('Portugal'),
				array('Romania'),
				array('Russia'),
				array('Sweden'),
				array('Switzerland'),
				array('Serbia & Montenegro'),
				array('Slovakia'),
				array('Slovenia'),
				array('Espana'),
				array('Czech Rep.'),
				array('Turkey'),
				array('Ukraine'),
				array('Hungary'),
				array('Belarus'),
				array('Cyprus'),
				array('Austria'),
				array('Afghanistan'),
				array('Armenia'),
				array('Azerbaijan'),
				array('Bangladesh'),
				array('Bhutan'),
				array('Brunei'),
				array('India'),
				array('Indonesia'),
				array('Japan'),
				array('Cambodia'),
				array('Kazakhstan'),
				array('Kyrgyzstan'),
				array('Laos'),
				array('Malaysia'),
				array('Maldives'),
				array('Mongolia'),
				array('Myanmar'),
				array('Nepal'),
				array('North Korea'),
				array('Pakistan'),
				array('Philippines'),
				array('Singapore'),
				array('Sri Lanka'),
				array('South Korea'),
				array('Tajikistan'),
				array('Taiwan'),
				array('Thailand'),
				array('Turkmenistan'),
				array('Uzbekistan'),
				array('Viet Nam'),
				array('Canada'),
				array('Mexico'),
				array('USA'),
				array('Antigua und Barbuda'),
				array('Aruba'),
				array('Bahamas'),
				array('Barbados'),
				array('Belize'),
				array('Bermuda'),
				array('Cayman Islands'),
				array('Costa Rica'),
				array('Curacao'),
				array('Dominica'),
				array('Dominican Rep.'),
				array('El Salvador'),
				array('Grenada'),
				array('Guadeloupe'),
				array('Guatemala'),
				array('Haiti'),
				array('Honduras'),
				array('Jamaica'),
				array('Virgin Islands'),
				array('Cuba'),
				array('Martinique'),
				array('Nicaragua'),
				array('Panama'),
				array('Puerto Rico'),
				array('St. Kitts und Nevis'),
				array('St. Lucia'),
				array('St. Maarten'),
				array('St. Vincent & Grenadin'),
				array('Trinidad & Tobago'),
				array('Argentina'),
				array('Bolivia'),
				array('Brazil'),
				array('Chile'),
				array('Ecuador'),
				array('Guyana'),
				array('Colombia'),
				array('Paraguay'),
				array('Peru'),
				array('Suriname'),
				array('Uruguay'),
				array('Venezuela'),
				array('Australia'),
				array('Fiji'),
				array('Marshall Islands'),
				array('Micronesia'),
				array('Nauru'),
				array('New Zealand'),
				array('Palau'),
				array('Papua New Guinea'),
				array('Samoa'),
				array('Tonga'),
				array('Tuvalu'),
				array('Vanuatu'),
				array('Bahrain'),
				array('Iraq'),
				array('Iran'),
				array('Israel'),
				array('Yemen'),
				array('Jordan'),
				array('Quatar'),
				array('Kuwait'),
				array('Lebanon'),
				array('Oman'),
				array('Palestinian authority'),
				array('Saudi Arabia'),
				array('Syria'),
				array('U.A.E.'),
				array('Algeria'),
				array('Angola'),
				array('Benin'),
				array('Botswana'),
				array('Burkina Faso'),
				array('Burundi'),
				array('Dem. Rep. of the Congo'),
				array('Djibouti'),
				array('Céte d\'\'Ivoire'),
				array('Eritrea'),
				array('Gabun'),
				array('Gambia'),
				array('Ghana'),
				array('Guinea'),
				array('Guinea-Bissau'),
				array('Cameroon'),
				array('Cape Verde'),
				array('Kenya'),
				array('Lesotho'),
				array('Liberia'),
				array('Libya'),
				array('Madagascar'),
				array('Malawi'),
				array('Mali'),
				array('Morocco'),
				array('Mauritania'),
				array('Mauritius'),
				array('Mozambique'),
				array('Namibia'),
				array('Niger'),
				array('Nigeria'),
				array('Dem. Rep. of the Congo'),
				array('Zambia'),
				array('Sao Tomé and Principe'),
				array('Senegal'),
				array('Seychelles'),
				array('Sierra Leone'),
				array('Simbabwe'),
				array('Somalia'),
				array('Sudan'),
				array('Swaziland'),
				array('South Africa'),
				array('Tanzania'),
				array('Togo'),
				array('Chad'),
				array('Tunisia'),
				array('Uganda'),
				array('Central African Rep.'),
				array('Egypt'),
				array('Guinea Equatorial'),
				array('Ethiopia'),
				array('La Réunion'),
				array('Solomon Islands'),
				array('French Guiana'),
			);

			#endregion

			#region wi_lastnames

			$tableMultiData['wi_lastnames'] = array(
				array('Binder'        , '1'),
				array('Noel'          , '1'),
				array('Young'         , '1'),
				array('Roux'          , '1'),
				array('Allen'         , '1'),
				array('Heron'         , '1'),
				array('Mansworld'     , '1'),
				array('Babbi'         , '1'),
				array('Crazys'        , '1'),
				array('Linden'        , '1'),
				array('Machlam'       , '1'),
				array('Notringham'    , '1'),
				array('Opus'          , '1'),
				array('Hausermann'    , '1'),
				array('McLachlan'     , '1'),
				array('McKinsey'      , '1'),
				array('Pohl'          , '1'),
				array('Schwarzenegger', '1'),
				array('Mueller'       , '1'),
				array('Nosemann'      , '1'),
				array('Obolus'        , '1'),
				array('Himbaer'       , '1'),
				array('Nala'          , '1'),
				array('Kandee'        , '1'),
				array('Bauer'         , '1'),
				array('Simons'        , '1'),
				array('Raptor'        , '1'),
				array('Maek'          , '1'),
				array('Huss'          , '1'),
				array('Mondial'       , '1'),
				array('Moondancer'    , '1'),
				array('Sweetheart'    , '1'),
				array('Schnuggy'      , '1'),
				array('Swindlehurst'  , '1'),
				array('Baumeister'    , '1'),
				array('Bloomberg'     , '1'),
				array('Dredd'         , '1'),
				array('Gridlock'      , '1'),
				array('Bohlen'        , '1'),
				array('Snapper'       , '1'),
				array('Tickle'        , '1'),
				array('Ewing'         , '1'),
				array('Schwinge'      , '1'),
				array('Nonsito'       , '1'),
			);

			#endregion

			#region wi_pagemanager

			$tableMultiData['wi_pagemanager'] = array(
				array('webui_menu_item_home'            , 1.0, '1', 'index.php?page=home'            , '_self', '2', null                       ),
				array('webui_menu_item_adminhome'       , 2.0, '1', 'index.php?page=adminhome'       , '_self', '3', null                       ),
				array('webui_menu_item_adminmanage'     , 2.1, '1', 'index.php?page=adminmanage'     , '_self', '3', 'webui_menu_item_adminhome'),
				array('webui_menu_item_adminsettings'   , 2.2, '1', 'index.php?page=adminsettings'   , '_self', '3', 'webui_menu_item_adminhome'),
				array('webui_menu_item_adminmodules'    , 2.3, '1', 'index.php?page=adminmodules'    , '_self', '3', 'webui_menu_item_adminhome'),
				array('webui_menu_item_adminloginscreen', 2.4, '1', 'index.php?page=adminloginscreen', '_self', '3', 'webui_menu_item_adminhome'),
				array('webui_menu_item_adminnewsmanager', 2.5, '1', 'index.php?page=adminnewsmanager', '_self', '3', 'webui_menu_item_adminhome'),
				array('webui_menu_item_adminsupport'    , 2.6, '1', 'index.php?page=adminsupport'    , '_self', '3', 'webui_menu_item_adminhome'),
				array('webui_menu_item_account'         , 3.0, '1', 'index.php?page=account'         , '_self', '1', null                       ),
				array('webui_menu_item_changeaccount'   , 3.1, '1', 'index.php?page=changeaccount'   , '_self', '1', 'webui_menu_item_account'  ),
				array('webui_menu_item_world'           , 4.0, '1', 'index.php?page=world'           , '_self', '2', null                       ),
				array('webui_menu_item_news'            , 4.1, '1', 'index.php?page=news'            , '_self', '2', 'webui_menu_item_world'    ),
				array('webui_menu_item_regions'         , 4.2, '1', 'index.php?page=regionlist'      , '_self', '2', 'webui_menu_item_world'    ),
				array('webui_menu_item_worldmap'        , 4.3, '1', 'index.php?page=worldmap'        , '_self', '2', 'webui_menu_item_world'    ),
				array('webui_menu_item_quickmap'        , 4.4, '1', 'index.php?page=quickmap'        , '_self', '2', 'webui_menu_item_world'    ),
				array('webui_menu_item_gallery'         , 4.5, '1', 'index.php?page=gallery'         , '_self', '2', 'webui_menu_item_world'    ),
				array('webui_menu_item_users'           , 5.0, '1', 'index.php?page=users'           , '_self', '1', null                       ),
				array('webui_menu_item_peoplesearch'    , 5.1, '1', 'index.php?page=peoplesearch'    , '_self', '1', 'webui_menu_item_users'    ),
				array('webui_menu_item_onlineusers'     , 5.2, '1', 'index.php?page=onlineusers'     , '_self', '1', 'webui_menu_item_users'    ),
				array('webui_menu_item_register'        , 6.0, '1', 'index.php?page=register'        , '_self', '0', null                       ),
				array('webui_menu_item_login'           , 7.0, '1', 'index.php?page=login'           , '_self', '0', null                       ),
				array('webui_menu_item_forgotpass'      , 7.1, '1', 'index.php?page=forgotpass'      , '_self', '0', 'webui_menu_item_login'    ),
				array('webui_menu_item_logout'          , 8.0, '1', 'index.php?page=logout'          , '_self', '1', null                       ),
				array('webui_menu_item_help'            , 9.0, '1', 'index.php?page=help'            , '_self', '2', null                       ),
				array('webui_menu_item_chat'            , 9.1, '1', 'index.php?page=chat'            , '_self', '2', 'webui_menu_item_help'     ),
				array('webui_menu_item_downloads'       , 9.2, '1', 'index.php?page=downloads'       , '_self', '2', 'webui_menu_item_help'     ),
				array('webui_menu_item_addgrid'         , 9.3, '1', 'index.php?page=addgrid'         , '_self', '2', 'webui_menu_item_help'     ),
				array('webui_menu_item_addserver'       , 9.4, '1', 'index.php?page=addserver'       , '_self', '2', 'webui_menu_item_help'     ),
			);

			#endregion

			#region wi_sitemanagement

			$tableMultiData['wi_sitemanagement'] = array(
				array('activate'        , 'main'   , 'activate.php'          ),
				array('activatemail'    , 'main'   , 'activatemail.php'      ),
				array('changeaccount'   , 'account', 'changeaccount.php'     ),
				array('forgotpass'      , 'account', 'forgotpass.php'        ),
				array('news'            , 'news'   , 'news.php'              ),
				array('home'            , 'main'   , 'home.php'              ),
				array('login'           , 'main'   , 'login.php'             ),
				array('logout'          , 'main'   , 'logout.php'            ),
				array('onlineusers'     , 'main'   , 'onlineusers.php'       ),
				array('peoplesearch'    , 'main'   , 'peoplesearch.php'      ),
				array('register'        , 'account', 'register.php'          ),
				array('regionlist'      , 'main'   , 'regionlist.php'        ),
				array('resetpass'       , 'account', 'resetpass.php'         ),
				array('worldmap'        , 'main'   , 'worldmap.php'          ),
				array('quickmap'        , 'main'   , 'quickmap.php'          ),
				array('adminhome'       , 'admin'  , 'home.php'              ),
				array('adminloginscreen', 'admin'  , 'loginscreenmanager.php'),
				array('adminnewsmanager', 'admin'  , 'newsmanager.php'       ),
				array('adminmanage'     , 'admin'  , 'manage.php'            ),
				array('news_add'        , 'admin'  , 'news_add.php'          ),
				array('news_edit'       , 'admin'  , 'news_edit.php'         ),
				array('adminsettings'   , 'admin'  , 'settings.php'          ),
				array('adminmodules'    , 'admin'  , 'modules.php'           ),
				array('adminedit'       , 'admin'  , 'edit.php'              ),
				array('account'         , 'account', 'main.php'              ),
				array('world'           , 'main'   , 'worldmain.php'         ),
				array('users'           , 'main'   , 'usersmain.php'         ),
				array('help'            , 'main'   , 'help.php'              ),
				array('chat'            , 'main'   , 'chat.php'              ),
				array('downloads'       , 'main'   , 'downloads.php'         ),
				array('addgrid'         , 'main'   , 'addgrid.php'           ),
				array('addserver'       , 'main'   , 'addserver.php'         ),
				array('gallery'         , 'main'   , 'gallery.php'           ),
				array('adminsupport'    , 'admin'  , 'support.php'           ),
			);

			#endregion

			#region wi_startscreen_infowindow

			$tableData['wi_startscreen_infowindow'] = array(
				'gridstatus' => '1',
				'active'     => '1',
				'color'      => 'yellow',
				'title'      => 'Info system Works very well ;-)',
				'message'    => 'Today we\'ve built a new loginscreen info system and it works very well. You can now see Info windows on the startup screen.'
			);

			#endregion

			#region wi_startscreen_news

			$tableData['wi_startscreen_news'] = array(
				'title'   => '[COMPLETE] The new loginscreen is done and works fine so far',
				'message' => '<p>We built a new loginscreen which will inform you about Grid updates or changes. Also you can now see how many users and regions are online, and more.  Also, you may from time to time see an infowindow, which informs you about important news.  Have Fun !</p>',
				'time'    => 1211321439,
				'user'    => 'Grid News',
			);

			#endregion

			#region wi_gallery

			$tableMultiData['wi_gallery'] = array(
				array('login1.jpg', 'image1thumbnail.jpg', 'Image 1 of our world', '1', '1'),
				array('login2.jpg', 'image2thumbnail.jpg', 'Image 2 of our world', '1', '1'),
				array('login3.jpg', 'image3thumbnail.jpg', 'Image 3 of our world', '1', '1'),
				array('login4.jpg', 'image4thumbnail.jpg', 'Image 4 of our world', '1', '1'),
				array('login5.jpg', 'image5thumbnail.jpg', 'Image 5 of our world', '1', '1'),
			);

			#endregion

			foreach(array_keys($tableData) as $tableName){
				if($genericData->TableExists($tableName) === false){
					error_log($tableName . ' does not exist');
					return;
				}
			}

			foreach(array_keys($tableMultiData) as $tableName){
				if($genericData->TableExists($tableName) === false){
					error_log($tableName . ' does not exist');
					return;
				}
			}

			foreach($tableData as $tableName => $tableDataInsert){
				$genericData->Insert($tableName, $tableDataInsert);
			}
			foreach($tableMultiData as $tableName => $rows){
				foreach($rows as $row){
					$genericData->Insert($tableName, $row);
				}
			}
		}


		protected function DoValidate(IDataConnector $genericData){
			return $this->TestThatAllTablesValidate($genericData);
		}


		protected function DoMigrate(IDataConnector $genericData){
			$this->DoCreateDefaults($genericData);
		}


		protected function DoPrepareRestorePoint(IDataConnector $genericData){
			$this->CopyAllTablesToTempVersions($genericData);
		}


		public function FinishedMigration(IDataConnector $genericData){

		}
	}
}
?>
