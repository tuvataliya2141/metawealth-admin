<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Verify your Account</title>
		<style type="text/css">
			@import url(https://fonts.googleapis.com/css?family=Open+Sans);
		</style>
	</head>
	<body style="border: 20px solid #c61678;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" height="100%" width="100%">
		<div class="container" width="70%" style="padding-left: 10% !important;padding-right: 10% !important;padding-top: 5% !important;">
			<div class="brandLogo" style="text-align: center;">
				<img src="{{ $details['img']; }}" style="height:15%;width:15%" alt="logo"/>
			</div>
			<div style="text-align: center;">
				<h1 style="color: #000000;font-family: 'Open Sans',serif;">Welcome to the Metawealth</h1>
			</div>
			<div style="text-align: center;">
					<p style="color: #000000;font-family: 'Open Sans',serif;font-size: 18px;">Please verify your account by clicking on the below link and login using below details.</p>
			</div>
			<div style="text-align: center;">
				<div style="margin: 20px;font-weight: bold;">
					<p style="color: #000000;font-family: 'Open Sans',serif;font-size: 16px;"><a href="{{ route('verification', [$details['user_id']]) }}" target="_blank">Verify Account</a></p>
				</div>
			</div>
			<div style="text-align: center;">
				<div style="margin: 20px;font-weight: bold;">
					<p style="color: #000000;font-family: 'Open Sans',serif;font-size: 16px;">Email:- {{ $details['email'] }}</p>
				</div>
			</div>
			<div style="text-align: center;">
				<div style="margin: 20px;font-weight: bold;">
					<p style="color: #000000;font-family: 'Open Sans',serif;font-size: 16px;">Password:- {{ $details['password'] }}</p>
				</div>
			</div>
		</div>
	</body>
</html>