<?php
?>
<body>
    <script>
        function createAlphabetSVG() {
            var svgContent = '<svg xmlns="http://www.w3.org/2000/svg" width="1000" height="100" viewBox="0 0 1000 100" fill="none">';
            var paths = {
                // A: "M20 0 L10 50 L30 50 Z M0 30 H40",
                // B: "M0 0 V50 H25 Q0 25 25 25 Q0 25 25 0 Q0 25 25 50 H0",
                C: "M25 0 Q0 0 0 25 Q0 50 25 50 H0",
                // D: "M0 0 V50 H25 Q50 50 50 25 V25 Q50 0 25 0 H0",
                // E: "M0 0 H50 V10 H10 V20 H50 V30 H10 V40 H50 V50 H0",
                // F: "M0 0 H50 V10 H10 V20 H50 V30 H10",
                // G: "M25 0 Q0 0 0 25 Q0 50 25 50 H0 V20 H20",
                // H: "M0 0 V50 M0 25 H50 M50 0 V50",
                // I: "M10 0 H40 V50 H10 M20 0 V50 M30 0 V50",
                // J: "M0 0 H30 Q0 0 0 30 Q0 50 30 50",
                // K: "M0 0 V50 M50 0 L0 25 L50 50",
                // L: "M0 0 V50 H40",
                // M: "M0 0 V50 L25 25 L50 50 V0",
                // N: "M0 0 V50 L50 0 V50",
                // O: "M25 0 Q0 0 0 25 Q0 50 25 50 Q50 50 50 25 Q50 0 25 0",
                // P: "M0 0 V50 H25 Q50 50 50 25 Q50 0 25 0",
                // Q: "M25 0 Q0 0 0 25 Q0 50 25 50 Q50 50 50 25 Q50 0 25 0 M30 30 L50 50",
                // R: "M0 0 V50 H25 Q50 50 50 25 Q50 0 25 0 L50 25",
                // S: "M0 10 Q0 0 25 0 Q50 0 50 25 Q50 40 25 50 Q0 50 0 40",
                // T: "M0 0 H50 V10 H20 V50 H30 V10 H50 V0 H0",
                // U: "M0 0 V50 Q0 0 25 0 Q50 0 50 50",
                // V: "M0 0 L25 50 L50 0",
                // W: "M0 0 L10 50 L25 25 L40 50 L50 0",
                // X: "M0 0 L50 50 M50 0 L0 50",
                // Y: "M0 0 L25 25 L50 0 M25 25 V50",
                // Z: "M0 0 H50 V10 H10 V20 H50 V30 H0",
            };
            for (var letter in paths) {
                svgContent += '<path d="' + paths[letter] + '" fill="none" stroke="black" stroke-width="2" />';
            }
            svgContent += '</svg>';
            return svgContent;
        }
        function downloadSVG(svg) {
            var blob = new Blob([svg], {type: 'image/svg+xml'});
            var url = URL.createObjectURL(blob);
            var a = document.createElement('a');
            a.href = url;
            a.download = 'canvas_to_svg.svg';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        }
        var alphabetSVG = createAlphabetSVG();
        downloadSVG(alphabetSVG);
    </script>
</body>