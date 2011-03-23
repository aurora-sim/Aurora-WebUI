<div id="gridstatus">
<table>
  <tbody>
  <tr>
    <td>
      <table>
        <tbody>
        <tr>
          <td class=gridbox_tl><img height=5 width=5 src="images/login_screens/spacer.gif" alt="" /></td>
          <td class=gridbox_t><img height=5 width=5 src="images/login_screens/spacer.gif" alt="" /></td>
          <td class=gridbox_tr><img height=5 width=5 src="images/login_screens/spacer.gif" alt="" /></td></tr>          
        </tr>
        <tr>
          <td class=gridbox_l></td>
          <td class=black_content>
            <table width="100%">
              <tbody>
              <tr bgColor=#000000>
                <td class=gridtext align=left><strong><? echo $webui_grid_status; ?>:</strong></td>
                  <td class=gridtext align=right>
                   <? if($GRIDSTATUS == 1){ ?>
                   <span class=online><? echo $webui_grid_status_online; ?></span>
                    <? } else { ?>
                    <span class=offline><? echo $webui_grid_status_offline; ?></span>
                    <? } ?>
                 </td>
              </tr>
              </tbody>
            </table>
            
            <div class="linegrey"></div>
            <table cellSpacing=0 cellPadding=0>
              <tbody>
              <tr bgColor=#151515>
                <td class=gridtext vAlign=top noWrap align=left><? echo $webui_total_users; ?>:</td>
                <td class=gridtext vAlign=top noWrap align=right width="1%"><?=$USERCOUNT?></td>
              </tr>
              <tr bgColor=#000000>
                <td class=gridtext vAlign=top noWrap align=left><? echo $webui_total_regions; ?>:</td>
                <td class=gridtext vAlign=top noWrap align=right width="1%"><?=$REGIONSCOUNT?></td>
              </tr>
              <tr bgColor=#151515>
                <td class=gridtext vAlign=top noWrap align=left><? echo $webui_unique_visitors; ?>:</td>
                <td class=gridtext vAlign=top noWrap align=right width="1%"><?=$LASTMONTHONLINE?></td>
              </tr>
			  <tr bgColor=#000000>
                <td class=gridtext vAlign=top noWrap align=left><strong><a href="index.php?page=onlineusers"><? echo $webui_online_now; ?></a>:</strong></td>
                <td class=gridtext vAlign=top noWrap align=right width="1%"><strong><?=$NOWONLINE?></strong></td>
              </tr>
			  </tbody></table></td>
          <td class=gridbox_r></td></tr>
        <tr>
          <td class=gridbox_bl></td>
          <td class=gridbox_b></td>
          <td class=gridbox_br></td>
        </tr>
      </tbody>
    </table>
  </td>
</tr>
</tbody>
</table>
</div><!-- end #gridstatus -->