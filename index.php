<?php
// Whitelist what the user can choose via the URL: index.php?shape=sphere&color=red
$allowedShapes = ['box', 'sphere', 'cylinder', 'cone'];
$allowedColors = ['red' => '#e74c3c', 'blue' => '#3498db', 'green' => '#2ecc71', 'gold' => '#f1c40f'];

$shape = $_GET['shape'] ?? 'box';
$color = $_GET['color'] ?? 'red';

if (!in_array($shape, $allowedShapes)) $shape = 'box';
if (!isset($allowedColors[$color])) $color = 'red';

$hex  = $allowedColors[$color];
$text = htmlspecialchars($_GET['text'] ?? 'Hello AR!', ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PHP AR Demo</title>
  <script src="https://aframe.io/releases/1.3.0/aframe.min.js"></script>
  <script src="https://cdn.jsdelivr.net/gh/AR-js-org/AR.js@3.4.5/aframe/build/aframe-ar.js"></script>
  <style>
    body { margin: 0; overflow: hidden; }
    #menu {
      position: fixed; top: 10px; left: 10px; z-index: 999;
      background: rgba(0,0,0,.6); color: #fff; padding: 8px 12px;
      font-family: sans-serif; font-size: 14px; border-radius: 8px;
    }
    #menu a { color: #8cf; margin-right: 6px; }
  </style>
</head>
<body>

<div id="menu">
  Shape:
  <?php foreach ($allowedShapes as $s): ?>
    <a href="?shape=<?= $s ?>&color=<?= $color ?>"><?= $s ?></a>
  <?php endforeach; ?>
  <br>Color:
  <?php foreach ($allowedColors as $name => $c): ?>
    <a href="?shape=<?= $shape ?>&color=<?= $name ?>"><?= $name ?></a>
  <?php endforeach; ?>
</div>

<a-scene embedded arjs="sourceType: webcam; debugUIEnabled: false;" vr-mode-ui="enabled: false">

  <!-- Point the camera at the Hiro marker -->
  <a-marker preset="hiro">

    <a-entity
      geometry="primitive: <?= $shape ?>"
      material="color: <?= $hex ?>; metalness: 0.3"
      position="0 0.5 0"
      scale="0.8 0.8 0.8"
      animation="property: rotation; to: 0 360 0; loop: true; dur: 5000; easing: linear">
    </a-entity>

    <a-text value="<?= $text ?>" align="center" color="#ffffff"
            position="0 1.6 0" scale="2 2 2" rotation="-90 0 0"></a-text>

  </a-marker>

  <a-entity camera></a-entity>
</a-scene>

</body>
</html>