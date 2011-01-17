<div id="gridstatus">

<table>
  <tbody>
  <tr>
    <td>
      <table>
        <tbody>
        <tr>
          <td class=gridbox_tl><img height=5 width=5 src="images/login_screens/spacer.gif" alt"WiRedux-Spacer" /></td>
          <td class=gridbox_t><img height=5 width=5 src="images/login_screens/spacer.gif" alt"WiRedux-Spacer" /></td>
          <td class=gridbox_tr><img height=5 width=5 src="images/login_screens/spacer.gif" alt"WiRedux-Spacer" /></td></tr>
        <tr>
          <td class=gridbox_l></td>
          <td class=black_content>
            <table width="100%">
              <tbody>
              <tr bgColor=#000000>
                <td class=gridtext align=left><strong>GRID STATUS:</strong></td>
                <td class=gridtext align=right>
				<? if($GRIDSTATUS == '1'){?>
				<span class=online>ONLINE</span>
				<? }else {?>
				<span class=offline>OFFLINE</span>
				<? } ?>
				
				</td></tr></tbody></table>
            <div id=grey style="MARGIN: 1px 0px 0px"><img height=1 src="images/login_screens/spacer.gif" width=1></div>
            <table cellSpacing=0 cellPadding=0>
              <tbody>
              <tr bgColor=#151515>
                <td class=gridtext vAlign=top noWrap align=left>Total Users:</td>
                <td class=gridtext vAlign=top noWrap align=right width="1%"><?=$USERCOUNT?></td>
              </tr>
              <tr bgColor=#000000>
                <td class=gridtext vAlign=top noWrap align=left>Total Regions:</td>
                <td class=gridtext vAlign=top noWrap align=right width="1%"><?=$REGIONSCOUNT?></td>
              </tr>
              <tr bgColor=#151515>
                <td class=gridtext vAlign=top noWrap align=left>Unique Visitors last 30 days:</td>
                <td class=gridtext vAlign=top noWrap align=right width="1%"><?=$LASTMONTHONLINE?></td>
              </tr>
			  <tr bgColor=#000000>
                <td class=gridtext vAlign=top noWrap align=left><strong>Online Now:</strong></td>
                <td class=gridtext vAlign=top noWrap align=right width="1%"><strong><?=$NOWONLINE?></strong></td>
              </tr>
			  </tbody></table></td>
          <td class=gridbox_r></td></tr>
        <tr>
          <td class=gridbox_bl></td>
          <td class=gridbox_b></td>
          <td class=gridbox_br></td></tr></tbody></table></td></tr></tbody></table>


<!-- END OFF GRID SATUS MODULE -->

</div>
