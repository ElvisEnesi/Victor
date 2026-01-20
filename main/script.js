// script file

// slideshow function for gallery
let slideIndex = 1;
slideShow(slideIndex);
// prev, next button functions
function pluSlides(n) {
    slideShow(slideIndex += n);
}
// slideshow function
function slideShow(n) {
    let i;
    let slides = document.getElementsByClassName("myslides");
    if (n > slides.length) {
        slideIndex = 1;
    }
    if (n < 1) {
        slideIndex = slides.length;
    }
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slides[slideIndex-1].style.display = "block";
}

// navbar
function openNavBar() {
    const open = document.querySelector(".show");
    const hide = document.querySelector(".hide");
    const navBar = document.querySelector(".nav");
    // open function
    navBar.style.right = "0px";
    open.classList.add("navIcon");
    hide.classList.add("show");
}
function closeNavBar() {
    const open = document.querySelector(".show");
    const hide = document.querySelector(".hide");
    const navBar = document.querySelector(".nav");
    // open function
    navBar.style.right = "-250px";
    open.classList.remove("navIcon");
    hide.classList.remove("show");
}

// show side bar
function openSideBar() {
    const openbtn = document.querySelector(".open_btn");
    const hidebtn = document.querySelector(".close_btn");
    const sideBar = document.querySelector("#aside");
    // open function
    openbtn.style.display = "none";
    hidebtn.style.display = "block";
    sideBar.style.left = "0px";
}
function closeSideBar() {
    const openbtn = document.querySelector(".open_btn");
    const hidebtn = document.querySelector(".close_btn");
    const sideBar = document.querySelector("#aside");
    // close function
    openbtn.style.display = "block";
    hidebtn.style.display = "none";
    sideBar.style.left = "-350px";
}

// displying discount & price by date
const today = new Date().getDay();
console.log(today);
if (today === 5) {
    let discounts = document.querySelectorAll(".discount"); 
    discounts.forEach(discount => { // Loop through each found element
        discount.style.display = "block";
    });
} else {
    let discounts = document.querySelectorAll(".discount");
    discounts.forEach(discount => {
        discount.style.display = "none";
    });
}
// for later <button onclick="deleteRecord(123)">Delete Item 123</button>
// function deleteRecord(itemId) {
//     // 1. Get the user's choice
//     const userConfirmed = confirm("Are you sure you want to delete this item?");

//     if (userConfirmed) {
//         // 2. If "Yes" (true), send a request to the PHP backend
//         fetch('api_delete.php', {
//             method: 'POST', // Use POST to send data securely
//             headers: {
//                 'Content-Type': 'application/x-www-form-urlencoded',
//             },
//             body: `action=delete&id=${itemId}` // Send key/value pairs
//         })
//         .then(response => response.text()) // Expect a text response from PHP
//         .then(data => {
//             // 3. Process the backend response
//             alert("Backend Response: " + data);
//             // You can reload the page or remove the item from the list here
//         })
//         .catch(error => {
//             console.error('Error:', error);
//             alert("An error occurred!");
//         });
//     } else {
//         // User clicked "No" (false)
//         alert("Action cancelled.");
//     }
// }
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
//     $action = htmlspecialchars($_POST['action']);
//     $itemId = htmlspecialchars($_POST['id']);

//     if ($action === 'delete') {
//         // Perform your database delete operation here
//         // Example: $db->query("DELETE FROM items WHERE id = $itemId");

//         // Send a response back to the JavaScript
//         echo "Item " . $itemId . " was successfully deleted from the database.";
//     } else {
//         echo "Invalid action provided.";
//     }
// } else {
//     // Handle cases where the script is accessed directly without POST data
//     echo "No valid request received.";
// }
// ?>
