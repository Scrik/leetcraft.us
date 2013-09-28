<!-- This page is put together by Prashanth -->

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Leetcraft Status Page</title>
    <link rel="stylesheet" type="text/css" href="css/leetcraft.css">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta http-equiv="refresh" content="20">
</head>
<body>

    <!-- Minecraft Server Status -->
    <div class="wrapper">
        <div class="container">
            <h1 class="text-center">Current status of Minecraft services (Mojang)</h1>
                <div class="text-center">
                    <?php
                        echo "<div class=\"text-center\">";
                        $json = file_get_contents("http://status.mojang.com/check");
                        if(!empty($json)) {
                            $result = json_decode($json,true);
                        }
                        if($result) {
                            foreach($result as $val) {
                                $tmp = array_keys($val);
                                $name = $tmp[0];
                                if($val[$name]=="green") {
                                    $name = str_replace(Array(".mojang.com",".minecraft.net"),"",$name);
                                    echo " <div id=\"services\" class=\"span2\">";
                                    echo " <div class='serviceup'>
                                    <div class=\"name\">$name</div>
                                    <h2 class=\"status\">UP</h2>
                                    </div></div>";
                                }
                                else{
                                    $name = str_replace(Array(".mojang.com",".minecraft.net"),"",$name);
                                    echo " <div id=\"services\" class=\"span2\">";
                                    echo " <div class='servicedown'>
                                    <div class=\"name\">$name</div>
                                    <h2 class=\"status\">DOWN</h2>
                                    </div></div>";
                                }

                            }
                        } else {
                                echo " <div id=\"services\" class=\"span2\">";
                                echo " <div class='servicedown'>
                                <div class=\"name\">MineCraft-All Services Down</div>
                                </div></div>";
                                }
                    ?>
            </div> <!-- Text Center --> 
        </div> <!-- Container -->
    </div> <!-- Wrapper -->

<br/>
<hr style="color:#0099FF;background-color:#0099FF;height:1px;border:none;width:60%"/>


    <!-- Leetcraft Server Status -->

    <?php

    // Server Uptime
    $data = shell_exec('uptime');
    $uptime = explode(' up ', $data);
    $uptime = explode(',', $uptime[1]);
    $uptime = $uptime[0].', '.$uptime[1];

    ?>

    <div class="wrapper">
        <div class="container">
            <h1 class="text-center">Current status of Leetcraft services (DigitalOcean) </h1>
            <!--<h2 class="text-center"> <?php echo 'Uptime - '.$uptime ?> </h2>  -->
                <div class="text-center">
                <?php
                    exec("pgrep ts3server_linux", $output, $return);
                    if ($return == 0) {
                        echo "<div id=\"TeamSpeak\" class=\"span2\">
                        <div class=\"serviceup\">
                        <div class=\"name\">TeamSpeak</div>
                        <h2 class=\"status\">UP</h2>
                        </div>
                        </div>";
                    } else {
                        echo "<div id=\"TeamSpeak\" class=\"span2\">
                        <div class=\"servicedown\">
                        <div class=\"name\">TeamSpeak</div>
                        <h2 class=\"status\">DOWN</h2>
                        </div>
                        </div>";
                    }

                    exec("pgrep java", $output, $return);
                    if ($return == 0) {
                        echo "<div id=\"MineCraft\" class=\"span2\">
                        <div class=\"serviceup\">
                        <div class=\"name\">MineCraft</div>
                        <h2 class=\"status\">UP</h2>
                        </div>
                        </div>";
                    } else {
                        echo "<div id=\"MineCraft\" class=\"span2\">
                        <div class=\"servicedown\">
                        <div class=\"name\">MineCraft</div>
                        <h2 class=\"status\">DOWN</h2>
                        </div>
                        </div>";
                    }

                    exec("pgrep httpd", $output, $return);
                    if ($return == 0) {
                        echo "<div id=\"Webserver\" class=\"span2\">
                        <div class=\"serviceup\">
                        <div class=\"name\">Webserver</div>
                        <h2 class=\"status\">UP</h2>
                        </div>
                        </div>";
                    } else {
                        echo "<div id=\"Webserver\" class=\"span2\">
                        <div class=\"servicedown\">
                        <div class=\"name\">Webserver</div>
                        <h2 class=\"status\">DOWN</h2>
                        </div>
                        </div>";
                    }

                    exec("pgrep vsftpd", $output, $return);
                    if ($return == 0) {
                        echo "<div id=\"ftp\" class=\"span2\">
                        <div class=\"serviceup\">
                        <div class=\"name\">SFTP</div>
                        <h2 class=\"status\">UP</h2>
                        </div>
                        </div>";
                    } else {
                        echo "<div id=\"ftp\" class=\"span2\">
                        <div class=\"servicedown\">
                        <div class=\"name\">SFTP</div>
                        <h2 class=\"status\">DOWN</h2>
                        </div>
                        </div>";
                    }

                    exec("pgrep fail2ban", $output, $return);
                    if ($return == 0) {
                        echo "<div id=\"fail2ban\" class=\"span2\">
                        <div class=\"serviceup\">
                        <div class=\"name\">Fail2Ban</div>
                        <h2 class=\"status\">UP</h2>
                        </div>
                        </div>";
                    } else {
                        echo "<div id=\"fail2ban\" class=\"span2\">
                        <div class=\"servicedown\">
                        <div class=\"name\">Fail2Ban</div>
                        <h2 class=\"status\">DOWN</h2>
                        </div>
                        </div>";
                    }

                ?>
            </div> <!-- Text Center --> 
        </div> <!-- Container -->
    </div> <!-- Wrapper -->

<br/>
<hr style="color:#0099FF;background-color:#0099FF;height:1px;border:none;width:60%"/>

    <!-- Leetcraft Server Current Status -->

    <div class="wrapper">
        <div class="container">
   <!--         <div class="text-center"> -->
                <?php
                    // Settings
                    define( 'MQ_SERVER_ADDR', 'leetcraft.us' );
                    define( 'MQ_SERVER_PORT', 25565 );
                    define( 'MQ_TIMEOUT', 1 );

                    require __DIR__ . '/MinecraftQuery.class.php';

                    $Timer = MicroTime( true );
                    $Query = new MinecraftQuery( );

                    try {
                        $Query->Connect( MQ_SERVER_ADDR, MQ_SERVER_PORT, MQ_TIMEOUT );
                    }
                    catch( MinecraftQueryException $e ) {
                        $Exception = $e;
                    }
                    $Timer = Number_Format( MicroTime( true ) - $Timer, 4, '.', '' );
                ?>

                <h1 align="center">Minecraft on Leetcraft Runtime settings</h1>

                <?php if( isset( $Exception ) ):
                echo htmlspecialchars( $Exception->getMessage( ) ); ?>
                <p><?php echo nl2br( $e->getTraceAsString(), false ); ?></p>
                <?php else: ?>

                <table>
                    <thead>
                        <tr>
                        <th>Online Players</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if( ( $Players = $Query->GetPlayers( ) ) !== false ): ?>
                        <?php foreach( $Players as $Player ): ?>
                        <tr>
                        <td><font color="#0099FF"><?php echo htmlspecialchars( $Player ); ?></font></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                        <td>No players currently on leetcraft server</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <table>
                    <thead>
                        <tr>
                        <th>Server Info</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if( ( $Info = $Query->GetInfo( ) ) !== false ): ?>
                        <?php foreach( $Info as $InfoKey => $InfoValue ): ?>
                        <tr>
                        <td><?php echo htmlspecialchars( $InfoKey ); ?></td>
                        <td><?php if( Is_Array( $InfoValue ) ){
                                    echo "<pre>";
                                    print_r( $InfoValue );
                                    echo "</pre>";
                                  } else{
                                          echo htmlspecialchars( $InfoValue );
                                  }
                            ?>
                        </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                        <td colspan="2">No information received</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <?php endif; ?>
            </div> <!-- Text Center --> 
        </div> <!-- Container -->
    </div> <!-- Wrapper -->

<br/>
<hr style="color:#0099FF;background-color:#0099FF;height:1px;border:none;width:60%"/>

<p align="center">Please email server admins for service issues to this mail box : admin at leetcraft dot us</p>

</body>
</html>


