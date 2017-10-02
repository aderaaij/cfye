<?php
define( 'DB_NAME', 'db_name' );
define( 'DB_USER', 'db_user' );
define( 'DB_PASSWORD', 'db_password' );
define( 'DB_HOST', 'localhost' );

define( 'WP_HOME', 'http://loc.wp-dawn.com');
define( 'WP_SITEURL', 'http://loc.wp-dawn.com/wp'); // Please don't forget the /wp at the end!

ini_set( 'display_errors', E_ALL );
define( 'WP_DEBUG_DISPLAY', true );
define( 'WP_DEBUG', true );

/* Generate Salts: https://api.wordpress.org/secret-key/1.1/salt/ */
define('AUTH_KEY',         'x,;;-@mt>7F+Sz3>qHr -*REw]v2z&RU#ZQ|BOaS,Cl4PtT/w?w7dk?4|m7-O)uy');
define('SECURE_AUTH_KEY',  '!FPBXU>xA`}|Z|b;S+@h:([cI+K::I;x+UE5ol]u#+6*a;w*M<&!8K6(^ld41--T');
define('LOGGED_IN_KEY',    'fEnH=Cf~<iV,Ii~g04>@`Idi[+VogqE@sK:@Zi+YBg<z0%I_OKW/a9%*c((R_OJ-');
define('NONCE_KEY',        'ZZ$X ^75E jVVwv#mk4-F+g<@rX`B_PDPC1|}~o6dFm)E^PetluBq+5)/Y4FZse2');
define('AUTH_SALT',        'N,l-_F{opL-VbXoBKMXOMhGnKZ8>f__ v f-j[o]~->c4(jy45~jsTX5/w,f<n<s');
define('SECURE_AUTH_SALT', ';#IQ2Z`Ump1v7`gRL%,cha8=j--|@e1oN|R4>&>e{OmoB*p^#Agg$r&/J@Pi/mCb');
define('LOGGED_IN_SALT',   'DS>}q`dF0lZh.If(ZE$/:Vk8be:TY2W5|v9+>[iobkkM5~j@o&A3+n-;=XhXNAOB');
define('NONCE_SALT',       'l[V;5njrMC2{dy {lzbhPs0Y|%Y|X`ufP$e&~r+haaS5BCVO;9[ iHK+>)W1tf*M');
