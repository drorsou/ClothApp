var item = {
    category: "Dress",
    color: "Black",
    price: "100",
    title: function() {return this.color+" "+this.category;}
};
var search_results = document.getElementById("col2");

var ul, li, p;
var i;
for (i = 1; i < 4; i++) {
    ul = document.createElement("ul");
    li = document.createElement("li");
    p = document.createElement("p");
    p.id = "output" + i;
    li.appendChild(p);
    ul.appendChild(li);
    ul.className = "search_item";
    search_results.appendChild(ul);
}

document.getElementById("output1").innerHTML = item.title();
document.getElementById("output2").innerHTML = "Result 2";
document.getElementById("output3").innerHTML = "Result 3";