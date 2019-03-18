<?php

use yii\helpers\Json;

?>
<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript">window.parent.andrewdanilov.inputImages.callFunction('<?= $this->params['id']; ?>', <?= JSON::encode($this->params['response']); ?>);</script>
</head>
<body>
</body>
</html>