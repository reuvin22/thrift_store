<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJM Thrift Store</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            background-color: #f8f9fa;
            color: #333;
        }

        header {
            background-color: #774601;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        header h1 {
            font-size: 2.5em;
            font-weight: 700;
            margin-bottom: 10px;
        }

        header p {
            font-size: 1.2em;
            margin-top: 5px;
        }

        section {
            padding: 50px 15%;
            max-width: 1200px;
            margin: 0 auto;
        }

        section h2 {
            color: #774601;
            font-size: 2em;
            margin-bottom: 15px;
        }

        .features,
        .offers {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        
        .feature-box {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 1.5s ease-out, transform 1.5s ease-out;
        }

        
        .feature-box.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .feature-box h3 {
            color: #774601;
            margin-bottom: 10px;
        }

        .feature-box p {
            color: #774601;
            font-size: 1em;
        }

        .cta {
            background-color: #774601;
            color: #fff;
            text-align: center;
            padding: 40px 0;
        }

        .cta h2 {
            font-size: 2em;
            margin-bottom: 15px;
        }

        .cta button {
            padding: 12px 24px;
            font-size: 1.1em;
            border: none;
            border-radius: 5px;
            background-color: #fff;
            color: black;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .cta button:hover {
            background-color: #eee;
        }

        .back-button-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
        }

        .back-button {
            background-color: #774601;
            color: #fff;
            padding: 12px 20px;
            font-size: 20px; 
            border: none;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .back-button:hover {
            background-color: #5a3702; 
        }
    </style>
</head>

<body>
    <header>
        <h1>Welcome to AJM Thrift Store</h1>
        <p>Your Treasure Hunt Awaits!</p>
    </header>

    <section>
        <h2>Why Choose AJM Thrift Store?</h2>
        <div class="features">
            <div class="feature-box">
                <h3>Sustainable Shopping</h3>
                <p>Embrace eco-friendly choices by shopping secondhand. Each purchase helps reduce waste and supports a
                    circular economy.</p>
            </div>
            <div class="feature-box">
                <h3>Affordable Prices</h3>
                <p>Discover hidden gems at unbeatable prices without compromising style. Stay stylish on a budget!</p>
            </div>
            <div class="feature-box">
                <h3>Ever-Changing Inventory</h3>
                <p>Our shelves are refreshed regularly. Visit often to find something unique and special every time!</p>
            </div>
            <div class="feature-box">
                <h3>Community Focused</h3>
                <p>Your purchases help support local charities and community initiatives. Shop and make a difference!</p>
            </div>
        </div>
    </section>

    <section>
        <h2>What We Offer</h2>
        <div class="offers">
            <div class="feature-box">
                <h3>Clothing & Accessories</h3>
                <p>Browse our collection of vintage and contemporary clothing for men, women, and children. Find your
                    unique style!</p>
            </div>
            <div class="feature-box">
                <h3>Seasonal Specials</h3>
                <p>Keep an eye on our themed sales and promotions. Celebrate special occasions with exclusive deals!</p>
            </div>
        </div>
    </section>

    <section class="cta">
        <h2>Visit Us Today!</h2>
        <p>Conveniently located at [address], we’re open [store hours]. Follow us on social media for updates on new
            arrivals, special events, and exclusive promotions!</p>
        <button>Join Our Community</button>
    </section>

    <div class="back-button-container">
        <a href="<?= base_url('/') ?>"><button class="back-button">
            Back
        </button></a>
    </div>

    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const featureBoxes = document.querySelectorAll('.feature-box');

            
            function isInViewport(element) {
                const rect = element.getBoundingClientRect();
                return rect.top >= 0 && rect.left >= 0 && rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) && rect.right <= (window.innerWidth || document.documentElement.clientWidth);
            }

            
            function handleScroll() {
                featureBoxes.forEach(box => {
                    if (isInViewport(box)) {
                        box.classList.add('visible');
                    }
                });
            }

            
            window.addEventListener('scroll', handleScroll);
            handleScroll(); 
        });
    </script>

</body>

</html>
