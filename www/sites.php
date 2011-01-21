<?

/*
 * Copyright (c) 2007 - 2011 Contributors, http://opensimulator.org/, http://aurora-sim.org/
 * See CONTRIBUTORS for a full list of copyright holders.
 *
 * See LICENSE for the full licensing terms of this file.
 *
 */

switch ($_SESSION[page]) {

    case '':

        include("./sites/home.php");

        return;

    case 'home':

        include("./sites/home.php");

        return;

    case 'change':

        include("./sites/changeacc.php");

        return;

    case 'forgotpass':

        include("./sites/forgotpw.php");

        return;

    case 'pwreset':

        include("./sites/pwreset.php");

        return;

    case 'activate':

        include("./sites/activate.php");

        return;

    case 'activatemail':

        include("./sites/activatemail.php");

        return;

    case 'gridstatus':

        include("./sites/news/gridnews.php");

        return;

    case 'gridstatushistory':

        include("./sites/news/newshistory.php");

        return;

    case 'smodul':

        include("./sites/sitemodul.php");

        return;

    case 'create':

        include("./sites/create.php");

        return;

    case 'regions':

        include("./sites/regionlist.php");

        return;

    case 'map':

        include("./sites/map.php");

        return;

    // End Search Additions

    case 'logout':

        include("./sites/logout.php");

        return;

    // Added Who's Online

    case 'online':

        include("./sites/whosonline.php");

        return;

    default:

        include("./sites/sitemodul.php");

        return;
}
?>
