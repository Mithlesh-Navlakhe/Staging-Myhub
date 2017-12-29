<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body class="font-grey">
  <div class="message-body">
	<h3>Dear <?php echo e($name); ?>, </h3>
	<p>Your total weekly hours are 
		<span class="font-bold font-ariel">
		  <b><?php echo e($totalTimes); ?> hrs</b> for a week <?php echo e($startdate); ?> - <?php echo e($enddate); ?>

		</span>
	</p>
	
	<div>
		<p>Thanks,<br>MyHub<br>Team Ignatiuz</p>
	</div>
  </div>
</body>
</html>
