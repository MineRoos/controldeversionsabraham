<html>
	<head>
	</head>
	<body>
		<?php 
		$ldapconfig['host']='localhost';
		$ldapconfig['port']=389; //Con NULL no funciona
		$ldapconfig['basedn']='dc=abraham,dc=m8,dc=org';
		
		$inicisessio=false;

		$ds = ldap_connect($ldapconfig['host'],$ldapconfig['port']);
		if( !$ds ) {
			exit(0); 
		}

		$r=ldap_search($ds,$ldapconfig['basedn'],'uid='.$user);
		
		if($r) {
			$result=ldap_get_entries($ds,$r);
			if(count($result)>0) {
				if($result[0]){
					ldap_set_option($ds,LDAP_OPT_PROTOCOL_VERSION,3);
					if(ldap_bind($ds,$result[0]['dn'],$pass)){
						$inicisessio=true;
					}
				}
			}
		}
		?>
	</body>
</html>
