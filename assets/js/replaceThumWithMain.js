const mainImage = document.getElementById("mainImage");
const thumbImage = document.getElementById("thumbImage");

// When main image finishes loading
mainImage.onload = function () {
  thumbImage.style.display = "none"; // hide thumbnail
  mainImage.style.display = "block"; // show main image
};