<!DOCTYPE html>
<html>
<head>
  <title>Live Test 9</title>
  <style>
    @keyframes my-animation {
      0% {
        transform: scale(0) rotate(0deg);
      }
      100% {
        transform: scale(1) rotate(360deg);
      }
    }

    .my-div {
      animation-name: my-animation;
      animation-duration: 2s;
      animation-fill-mode: forwards; 
    }
  </style>
</head>
<body>
  <div class="my-div">Live Test 9 from Ostad!</div>
</body>
</html>