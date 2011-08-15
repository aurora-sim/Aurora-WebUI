<table cellSpacing=0 cellPadding=0 border=0>
  <tbody>
  <tr>
  <td vAlign=top align=right>
    <table cellSpacing=0 cellPadding=0 width=300 border=0>
      <tbody>
      <tr>
        <td class=gridbox_tl><img height=5 width=5 src="<?php echo SYSURL; ?>loginscreen/images/icons/spacer.gif" alt="" /></td>
        <td class=gridbox_t><img height=5 width=5 src="<?php echo SYSURL; ?>loginscreen/images/icons/spacer.gif" alt="" /></td>
        <td class=gridbox_tr><img height=5 width=5 src="<?php echo SYSURL; ?>loginscreen/images/icons/spacer.gif" alt="" /></td>
      </tr>
      <tr>
        <td class=gridbox_l></td>
        <td class=black_content>
          <table cellSpacing=0 cellPadding=1 width="100%" border=0>
            <tbody>
            <tr>
              <td class=gridtext align=left><strong><?php echo $webui_grid_status; ?>:</strong></td>
              <td class=gridtext align=right>
                <?php if ($GRIDSTATUS == true) { ?>
                  <span class=online><?php echo $webui_grid_status_online; ?></span>
                <?php } else { ?>
                  <span class=offline><?php echo $webui_grid_status_offline; ?></span>
                <?php } ?>
              </td>
            </tr>
            </tbody>
          </table>

          <div id=grex style="margin: 1px 0px 0px">
            <img height=1 src="<?php echo SYSURL; ?>loginscreen/images/icons/spacer.gif" width=1>
          </div>

          <table cellSpacing=0 cellPadding=0 width="100%" border=0>
            <tbody>
            <tr class=odd>
              <td class=gridtext vAlign=top noWrap align=left><?php echo $webui_total_users ?>:</td>
              <td class=gridtext vAlign=top noWrap align=right width="1%"><?php echo $USERCOUNT; ?></td>
            </tr>
            
            <tr class=even>
              <td class=gridtext vAlign=top noWrap align=left><?php echo $webui_total_regions; ?>:</td>
              <td class=gridtext vAlign=top noWrap align=right width="1%"><?php echo $REGIONSCOUNT; ?></td>
            </tr>
            
            <tr class=odd>
              <td class=gridtext vAlign=top noWrap align=left><?php echo $webui_unique_visitors; ?>:</td>
              <td class=gridtext vAlign=top noWrap align=right width="1%"><?php echo $LASTMONTHONLINE; ?></td>
            </tr>
            
            <tr class=even>
              <td class=gridtext vAlign=top noWrap align=left><a href="<?php echo SYSURL; ?>index.php?page=onlineusers" target="_blank"><?php echo $webui_online_now; ?></a>:</td>
              <td class=gridtext vAlign=top noWrap align=right width="1%"><strong><?php echo $NOWONLINE; ?></strong></td>
            </tr>                                          

            <tr class=odd>
              <td class=gridtext vAlign=top noWrap align=left><?php echo $webui_iwc; ?>:</td>
                <?php if ($AddGrid_IWC_Actived == true) { ?>
                  <td class=gridtext vAlign=top noWrap align=right width="1%"><span class=online><?php echo $webui_iwc_actived; ?></span></td>
                <?php } else { ?>
                  <td class=gridtext vAlign=top noWrap align=right width="1%"><span class=offline><?php echo $webui_iwc_desactived; ?></span></td>
                <?php } ?>
            </tr>
                                            
            <tr class=even>
              <td class=gridtext vAlign=top noWrap align=left><?php echo $webui_hg; ?>:</td>
                <?php if ($AddGrid_HG_Actived  == true) { ?>
                  <td class=gridtext vAlign=top noWrap align=right width="1%"><span class=online><?php echo $webui_hg_actived; ?></span></td>
                <?php } else { ?>
                  <td class=gridtext vAlign=top noWrap align=right width="1%"><span class=offline><?php echo $webui_hg_desactived; ?></span></td>
                <?php } ?>
            </tr>
                                            
            <tr class=odd>
              <td class=gridtext vAlign=top noWrap align=left><?php echo $webui_voice; ?>:</td>
                <?php if ($AddGrid_Voice_Actived == true) { ?>
                  <td class=gridtext vAlign=top noWrap align=right width="1%"><span class=online><?php echo $webui_voice_actived; ?></span></td>
                <?php } else { ?>
                  <td class=gridtext vAlign=top noWrap align=right width="1%"><span class=offline><?php echo $webui_voice_desactived; ?></span></td>
                <?php } ?>
            </tr>

            <tr class=even>
              <td class=gridtext vAlign=top noWrap align=left><?php echo $webui_currency; ?>:</td>
                <?php if ($AddGrid_Currency_Actived == true) { ?>
                  <td class=gridtext vAlign=top noWrap align=right width="1%"><span class=online><?php echo $webui_currency_actived; ?></span></td>
                <?php } else { ?>
                  <td class=gridtext vAlign=top noWrap align=right width="1%"><span class=offline><?php echo $webui_currency_desactived; ?></span></td>
                <?php } ?>
            </tr>
            </tbody>
          </table>
        </td>
        <td class=gridbox_r></td>
        </tr>
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
