<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>One-Sided Price Slider</title>
<style>
  .slider-container {
    width: 80%;
    margin: 50px auto;
  }
  input[type="range"] {
    -webkit-appearance: none;
    width: 100%;
    height: 25px;
    background: #d3d3d3;
    border-radius: 5px;
    outline: none;
    opacity: 0.7;
    -webkit-transition: .2s;
    transition: opacity .2s;
  }
  input[type="range"]:hover {
    opacity: 1;
  }
  input[type="range"]::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 25px;
    height: 25px;
    background: #4CAF50;
    border-radius: 50%;
    cursor: pointer;
  }
  input[type="range"]::-moz-range-thumb {
    width: 25px;
    height: 25px;
    background: #4CAF50;
    border-radius: 50%;
    cursor: pointer;
  }
</style>
</head>
<body>
<div class="slider-container">
  <input type="range" min="0" max="100" value="50" step="1" id="priceSlider">
</div>

<script>
  const slider = document.getElementById("priceSlider");
  const minPrice = 0;
  const maxPrice = 100;

  slider.oninput = function() {
    // Update the slider value display or perform other actions here
    console.log(this.value);
  };
</script>
</body>
</html>
