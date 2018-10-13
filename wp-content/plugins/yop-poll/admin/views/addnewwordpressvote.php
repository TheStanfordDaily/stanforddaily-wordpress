<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<style src="<?php echo YOP_POLL_URL?>/public/assets/css/yop-poll-public.css"></style>
		<script type="text/javascript">
			function closeWindow() {
				var userProfile = [], puid, pollObject;
				window.opener.YOPPollBasicUpdateToken( <?php echo $poll_id;?>, '<?php echo wp_create_nonce( 'yop-poll-vote-' . $poll_id );?>');
				userProfile.id = '';
				userProfile.firstName = '';
				userProfile.lastName = '';
				userProfile.email = '';
				puid = '<?php echo $_REQUEST['puid']; ?>';
				pollObject = window.opener.document.querySelectorAll( "[data-uid='" + puid + "']" );
				var result = window.opener.YOPPollSendBasicVote( pollObject, 'wordpress', userProfile );
				if( 1 === result ) {
					window.close();
				}
			}
		</script>
	</head>
	<body onload="closeWindow()">
		<div class="basic-overlay" style="width: 100%; height: 100%; text-align: center;">
        </div>
    </body>
</html>
