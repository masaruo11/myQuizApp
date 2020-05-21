"use strict";

(() => {
    class IconDrawer {
        constructor(canvas) {
            this.ctx = canvas.getContext("2d");
            this.width = canvas.width;
            this.height = canvas.height;
            this.r = 20;
        }

        draw(angle) {
            this.ctx.fillStyle = "rgba(255,255,255,0.5)";
            this.ctx.fillRect(0, 0, this.width, this.height);

            this.ctx.save();
            this.ctx.translate(this.width / 2, this.height / 2);
            // this.ctx.rotate();
            this.ctx.rotate(Math.PI / 180 * angle);
            // this.ctx.rotate(angle*100);
            this.ctx.beginPath();
            this.ctx.moveTo(0, -this.r - 5);
            this.ctx.lineTo(0, -this.r + 5);
            this.ctx.strokeStyle = "orange";
            this.ctx.lineWidth = 6;
            // this.ctx.filltext("Replay?", 10, 10);
            this.ctx.stroke();
            this.ctx.restore();
        }
    }

    class Icon {
        constructor(drawer) {
            this.drawer = drawer;
            this.angle = 0;
        }

        draw() {
            this.drawer.draw(this.angle);
        }

        update() {
            this.angle += 10;
        }

        run() {
            this.update();
            this.draw();

            setTimeout(() => {
                this.run();
            }, 100);
        }
    }

    const canvas = document.querySelector("canvas");
    if (typeof canvas.getContext === "undefined") {
        return;
    }

    const icon = new Icon(new IconDrawer(canvas));
    icon.run();
})();