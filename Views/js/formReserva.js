const textarea = document.getElementById
("exampleFormControlTextarea1");
exampleFormControlTextarea1.style.cssText = `height: ${
    exampleFormControlTextarea1.scrollHeight}
    px; overflow-y: hidden`;

    exampleFormControlTextarea1.addEventListener("input", function(){
        this.style.height = "auto";
        this.style.height = `${this.scrollHeight}px`;
    });