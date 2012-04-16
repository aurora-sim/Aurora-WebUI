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


	class WebUI_1 extends Migrator{

		const Version = '0.0.1';

		const MigrationName = 'Wiredux';


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

			$this->RemoveSchema('wi_sitemanagement');
			$this->RemoveSchema('wi_pagemanager');
		}


		protected function DoCreateDefaults(IDataConnector $genericData){
			$this->EnsureAllTablesInSchemaExist($genericData);
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
