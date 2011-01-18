<TABLE cellSpacing=0 cellPadding=0 border=0>
    <TBODY>
        <TR>
            <TD vAlign=top align=right>
                <TABLE cellSpacing=0 cellPadding=0 width=300 border=0>
                    <TBODY>
                        <TR>
                            <TD class=gridbox_tl><IMG height=5
                                                      src="images/login_screens/spacer.gif"
                                                      width=5></TD>
                            <TD class=gridbox_t><IMG height=5
                                                     src="images/login_screens/spacer.gif"
                                                     width=5></TD>
                            <TD class=gridbox_tr><IMG height=5
                                                      src="images/login_screens/spacer.gif"
                                                      width=5></TD></TR>
                        <TR>
                            <TD class=gridbox_l></TD>
                            <TD class=black_content>
                                <TABLE cellSpacing=0 cellPadding=1 width="100%" border=0>
                                    <TBODY>
                                        <TR>
                                            <TD class=gridtext align=left><STRONG>GRID
                                                    STATUS:</STRONG></TD>
                                            <TD class=gridtext align=right>
                                                <?
                                                if ($GRIDSTATUS == 1) {
                                                ?>
                                                    <SPAN class=ONLINE>ONLINE</SPAN>
                                                <? } else {
 ?>
                                                    <SPAN class=OFFLINE>OFFLINE</SPAN>
<? } ?>

                                            </TD></TR></TBODY></TABLE>
                                <DIV id=GREX style="MARGIN: 1px 0px 0px"><IMG
                                        height=1
                                        src="images/login_screens/spacer.gif"
                                        width=1></DIV>
                                <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                                    <TBODY>
                                        <TR bgColor=#151515>
                                            <TD class=gridtext vAlign=top noWrap align=left>Total Users:</TD>
                                            <TD class=gridtext vAlign=top noWrap align=right
                                                width="1%"><?= $USERCOUNT ?></TD>
                                        </TR>
                                        <TR bgColor=#000000>
                                            <TD class=gridtext vAlign=top noWrap align=left>Total Regions:</TD>
                                            <TD class=gridtext vAlign=top noWrap align=right
                                                width="1%"><?= $REGIONSCOUNT ?></TD>
                                        </TR>
                                        <TR bgColor=#151515>
                                            <TD class=gridtext vAlign=top noWrap align=left>Unique Visitors last 30 days:</TD>
                                            <TD class=gridtext vAlign=top noWrap align=right
                                                width="1%"><?= $LASTMONTHONLINE ?></TD>
                                        </TR>
                                        <TR bgColor=#000000>
                                            <TD class=gridtext vAlign=top noWrap align=left><STRONG>Online Now:</STRONG></TD>
                                            <TD class=gridtext vAlign=top noWrap align=right
                                                width="1%"><STRONG><?= $NOWONLINE ?></STRONG></TD>
                                        </TR>
                                    </TBODY></TABLE></TD>
                            <TD class=gridbox_r></TD></TR>
                        <TR>
                            <TD class=gridbox_bl></TD>
                            <TD class=gridbox_b></TD>
                            <TD
                                class=gridbox_br></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>