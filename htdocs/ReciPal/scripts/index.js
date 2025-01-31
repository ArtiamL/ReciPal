

// let showPost = function(response, isCurated) {
//     if (respose.readyState === 4 && response.status === 200){
//         if (isCurated) {
//             const container = document.getElementById("curated_posts");
//             // const template =
//             let curated = JSON.parse(response.responseText);
//             curated.forEach((element) => {
//
//             })
//         }
//
//     }
// }

// function parseTemplate(template, container) {
//     return fetch(template)
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error("Failed to parse template");
//             }
//             return response.text();
//         })
//         .then(html => {
//             const templateContainer = document.createElement("div");
//             templateContainer.innerHTML = html;
//             const template = templateContainer.querySelector("#post_collapsed");
//             const elemContainer = container;
//         })
// }

async function getCuratedPosts() {
    const response = await fetch('./api/posts/curated/short');
    return await response.json();
}

document.onreadystatechange = function () {
    if (document.readyState === "complete") {
        getCuratedPosts().then(r => console.log(r));




        // const post_collapsed = template.getElementById("post_collapsed");
        // const clone = post_collapsed.content.cloneNode(true);
        // clone.querySelector(".post_heading").innerHTML = "Hello, world!";
        // container.appendChild(post_collapsed);
    }
}