<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canvas to SVG Conversion</title>
    <style>
        #canvas {
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <canvas id="canvas" width="300" height="150"></canvas><br>
    <button id="convertBtn">Convert to SVG</button>
    <script>
        document.getElementById('convertBtn').addEventListener('click', function() {
            var canvas = document.getElementById('canvas');
            // var svg = canvasToSVG(canvas);
            var customSVG = createAlphabetSVG();
            // downloadSVG(svg);
            downloadSVG(customSVG);
        });
        function canvasToSVG(canvas) {
            var svg = '<svg xmlns="http://www.w3.org/2000/svg" width="' + canvas.width + '" height="' + canvas.height + '">';
            svg += '<foreignObject width="100%" height="100%"><div xmlns="http://www.w3.org/1999/xhtml">';
            svg += '<style>h1 { font-size: 20px; color: red; }</style>';
            svg += '<h1>This is a sample text with formatting.</h1>';
            svg += '</div></foreignObject></svg>';
            return svg;
        }
        // function createCustomSVG() {
        //     var svgContent = '<svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" viewBox="0 0 56 56" fill="none">';
        //     svgContent += '<g clip-path="url(#clip0_31_59)">';
        //     svgContent += '<path d="M18.6667 9.33331H14C11.4227 9.33331 9.33334 11.4227 9.33334 14V16.3333C9.33334 18.9106 11.4227 21 14 21H18.6667C21.244 21 23.3333 18.9106 23.3333 16.3333V14C23.3333 11.4227 21.244 9.33331 18.6667 9.33331Z" stroke="#252525" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>';
        //     svgContent += '<path d="M18.6667 30.3333H14C11.4227 30.3333 9.33334 32.4227 9.33334 35V42C9.33334 44.5773 11.4227 46.6666 14 46.6666H18.6667C21.244 46.6666 23.3333 44.5773 23.3333 42V35C23.3333 32.4227 21.244 30.3333 18.6667 30.3333Z" stroke="#252525" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>';
        //     svgContent += '<path d="M42 9.33331H37.3333C34.756 9.33331 32.6667 11.4227 32.6667 14V42C32.6667 44.5773 34.756 46.6666 37.3333 46.6666H42C44.5773 46.6666 46.6667 44.5773 46.6667 42V14C46.6667 11.4227 44.5773 9.33331 42 9.33331Z" stroke="#252525" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>';
        //     svgContent += '</g>';
        //     svgContent += '<defs><clipPath id="clip0_31_59"><rect width="56" height="56" fill="white"></rect></clipPath></defs>';
        //     svgContent += '</svg>';
        //     return svgContent;
        // }
        // function createDynamicSVG(text) {
        //     var svgContent = '<svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" viewBox="0 0 56 56" fill="none">';
        //     svgContent += '<g clip-path="url(#clip0_31_59)">';
        //     svgContent += '<path d="M18.6667 9.33331H14C11.4227 9.33331 9.33334 11.4227 9.33334 14V16.3333C9.33334 18.9106 11.4227 21 14 21H18.6667C21.244 21 23.3333 18.9106 23.3333 16.3333V14C23.3333 11.4227 21.244 9.33331 18.6667 9.33331Z" stroke="#252525" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>';
        //     svgContent += '<path d="M18.6667 30.3333H14C11.4227 30.3333 9.33334 32.4227 9.33334 35V42C9.33334 44.5773 11.4227 46.6666 14 46.6666H18.6667C21.244 46.6666 23.3333 44.5773 23.3333 42V35C23.3333 32.4227 21.244 30.3333 18.6667 30.3333Z" stroke="#252525" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>';
        //     svgContent += '<path d="M42 9.33331H37.3333C34.756 9.33331 32.6667 11.4227 32.6667 14V42C32.6667 44.5773 34.756 46.6666 37.3333 46.6666H42C44.5773 46.6666 46.6667 44.5773 46.6667 42V14C46.6667 11.4227 44.5773 9.33331 42 9.33331Z" stroke="#252525" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>';
        //     svgContent += '</g>';
        //     svgContent += '<text x="50%" y="50%" text-anchor="middle" dominant-baseline="middle" font-size="16" fill="red">' + text + '</text>';
        //     svgContent += '</svg>';
        //     return svgContent;
        // }
        function createAlphabetSVG() {
            var svgContent = '<svg xmlns="http://www.w3.org/2000/svg" fill="none">';
            var paths = {
                A: "M20 0 L10 50 L30 50 Z M0 30 H40",
                B: "M0 0 V50 H25 Q0 25 25 25 Q0 25 25 0 Q0 25 25 50 H0",
                C: "M25 0 Q0 0 0 25 Q0 50 25 50 H0",
                D: "M0 0 V50 H25 Q50 50 50 25 V25 Q50 0 25 0 H0",
                E: "M0 0 H50 V10 H10 V20 H50 V30 H10 V40 H50 V50 H0",
                F: "M0 0 H50 V10 H10 V20 H50 V30 H10",
                G: "M25 0 Q0 0 0 25 Q0 50 25 50 H0 V20 H20",
                H: "M0 0 V50 M0 25 H50 M50 0 V50",
                I: "M10 0 H40 V50 H10 M20 0 V50 M30 0 V50",
                J: "M0 0 H30 Q0 0 0 30 Q0 50 30 50",
                K: "M0 0 V50 M50 0 L0 25 L50 50",
                L: "M0 0 V50 H40",
                M: "M0 0 V50 L25 25 L50 50 V0",
                N: "M0 0 V50 L50 0 V50",
                O: "M25 0 Q0 0 0 25 Q0 50 25 50 Q50 50 50 25 Q50 0 25 0",
                P: "M0 0 V50 H25 Q50 50 50 25 Q50 0 25 0",
                Q: "M25 0 Q0 0 0 25 Q0 50 25 50 Q50 50 50 25 Q50 0 25 0 M30 30 L50 50",
                R: "M0 0 V50 H25 Q50 50 50 25 Q50 0 25 0 L50 25",
                S: "M0 10 Q0 0 25 0 Q50 0 50 25 Q50 40 25 50 Q0 50 0 40",
                T: "M0 0 H50 V10 H20 V50 H30 V10 H50 V0 H0",
                U: "M0 0 V50 Q0 0 25 0 Q50 0 50 50",
                V: "M0 0 L25 50 L50 0",
                W: "M0 0 L10 50 L25 25 L40 50 L50 0",
                X: "M0 0 L50 50 M50 0 L0 50",
                Y: "M0 0 L25 25 L50 0 M25 25 V50",
                Z: "M0 0 H50 V10 H10 V20 H50 V30 H0",
            };
            for (var letter in paths) {
                svgContent += '<path d="' + paths[letter] + '" fill="none" stroke="black" stroke-width="2" />';
            }
            svgContent += '</svg>';
            return svgContent;
        }
        function createAlphabetSVG() {
            var svgContent = '<svg xmlns="http://www.w3.org/2000/svg" width="1000" height="100" viewBox="0 0 1000 100" fill="none">';
            var paths = {
                A: "M20 0 L10 50 L30 50 Z M0 30 H40",
                B: "M0 0 V50 H25 Q0 25 25 25 Q0 25 25 0 Q0 25 25 50 H0",
                Z: "M0 0 H50 V10 H10 V20 H50 V30 H0",
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
    </script>
</body>
</html>