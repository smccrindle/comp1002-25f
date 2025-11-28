// STEP C: Get the current URL for the page
const pageURL = window.location.href;
console.log(pageURL);
// STEP D: Grab all the top-level <a> elements inside the <nav> element at the top of the page (inside the <header> element)
const navLinks = document.querySelectorAll("header nav > ul > li > a");
console.log(navLinks);
// STEP E: Create a place to store the href value for each <a> element
let linkURL;
// STEP F: For each <a> element in the NodeList navLinks, compare the href property with the URL for the current page
navLinks.forEach((element) => {
    // STEP G: Grab the href property of each <a> (element)
    linkURL = element.href;
    console.log(linkURL);
    // STEP H: Check for a match with the current page
    if(linkURL == pageURL) {
        // STEP I: They match - so this <a> is the link for the current page
        element.classList.add("current");
    };
});