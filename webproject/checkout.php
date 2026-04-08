<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Title</title>
        <link rel="stylesheet" href="checkout.css" type="text/css" />
    </head>
    <body>
        <div id="header">
            <div id="logo">
                <a href="home.html"> <img src="projectimg/FInal-removebg-preview.png" alt="" /> </a>
            </div>
            <div class="nav" id="nav1">
                <a href="home.html" id="active"><h2>Home</h2></a>
            </div>
            <div class="nav">
                <a href="home.html"> <h2>About</h2></a>
            </div>
            <div class="nav">
                <a href="home.html"><h2>FAQ</h2></a>
            </div>
            <div class="nav" id="search">
                <form>
                    <input type="text" placeholder="Search.." name="search" />
                    <button type="submit"><img src="projectimg/search.jpg" alt="Icon" /></button>
                </form>
            </div>
            <div class="nav" id="profile">
                <a href=""><img src="projectimg/profile.jpg" /> </a>
            </div>
            <div class="nav" id="cart">
                <a href=""><img src="projectimg/cart.png" /> </a>
            </div>
        </div>

        <div id="main">
            <div id="upper">
                <a href="javascript:history.back();">
                    <div id="back">
                        <img src="projectimg/back.png" alt="" />
                        <h1>ORDER SUMMARY</h1>
                    </div>
                </a>
            </div>
            <div id="container">
                <div id="methods">
                    <div id="email">
                        <img src="projectimg/profile.jpg" alt="" />
                        <h4>gianhakdog24@gmail.com</h4>
                    </div>
                    <div class="option-selector">
                        <button type="button" class="option active" data-method="ship">
                            <img src="projectimg/truck.png" alt="" />Ship
                        </button>
                        <button type="button" class="option" data-method="pickup">
                            <img src="projectimg/location.png" alt="" />Pickup
                        </button>
                    </div>

                    <div id="shipDiv" class="methodDiv">
                        <h4>Shipping Information</h4>
                        <form>
                            <div class="row">
                                <div class="field">
                                    <label for="fname">First Name</label>
                                    <input type="text" id="fname" name="fname" required />
                                </div>
                                <div class="field">
                                    <label for="lname">Last Name</label>
                                    <input type="text" id="lname" name="lname" required />
                                </div>
                            </div>

                            <label for="address">Address</label>
                            <input type="text" id="address" name="address" required />

                            <label for="apt">Apartment, suite, etc. (Optional)</label>
                            <input type="text" id="apt" name="apt" />

                            <div class="row">
                                <div class="field">
                                    <label for="city">City</label>
                                    <select id="city" name="city">
                                        <option value="manila">Manila</option>
                                        <option value="quezon">Quezon City</option>
                                        <option value="makati">Makati</option>
                                    </select>
                                </div>
                                <div class="field">
                                    <label for="province">Province</label>
                                    <select id="province" name="province">
                                        <option value="ncr">NCR</option>
                                        <option value="central-luzon">Central Luzon</option>
                                        <option value="calabarzon">CALABARZON</option>
                                    </select>
                                </div>
                            </div>

                            <label for="zip">ZIP Code</label>
                            <input type="text" id="zip" name="zip" required />

                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" required />
                        </form>
                        <div class="payment-section">
                            <h2>Payment</h2>
                            <p>All transactions are secure and encrypted.</p>

                            <div class="radio-option">
                                <label>
                                    <input type="radio" name="payment" value="bank" checked="" />
                                    Bank Payment
                                </label>
                                <div class="expandable">
                                    <p>
                                        Make your payment directly into our bank or Gcash account. Please send proof of
                                        payment as a reply to the order email you received.
                                    </p>
                                </div>
                            </div>

                            <div class="radio-option">
                                <label>
                                    <input type="radio" name="payment" value="gcash" />
                                    Gcash / PayMaya
                                </label>
                                <div class="expandable">
                                    <p>
                                        Send your payment directly to our gcash/paymaya account.
Number:
0917 874 8039
                                    </p>
                                </div>
                            </div>

                            <div class="radio-option">
                                <label>
                                    <input type="radio" name="payment" value="paypal" />
                                    Paypal
                                </label>
                                <div class="expandable">
                                    <p>
                                        We'll send an invoice with the invoice fee to your registered email.
You may
                                        also send the payment directly to order@otakuhobbitoysph.com as family and
                                        friends.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="pickupDiv" class="methodDiv" style="display: none">
                        <div class="pickup-header">Pickup location</div>
                        <div class="pickup-body">
                            <div class="pickup-info">
                                <strong>Bulacan, Philippines</strong><br />
                                #70 Malamig Street, Poblacion, Bustos
                            </div>
                            <div class="pickup-icon">
                                <img src="projectimg/check.png" alt="Confirmed" />
                            </div>
                        </div>
                        <div class="payment-section">
                            <h2>Payment</h2>
                            <p>All transactions are secure and encrypted.</p>

                            <div class="radio-option">
                                <label>
                                    <input type="radio" name="payment" value="bank" checked="" />
                                    Cash
                                </label>
                                <div class="expandable">
                                    <p>Payment in Cash while picking the package in the store location.</p>
                                </div>
                            </div>

                            <div class="radio-option">
                                <label>
                                    <input type="radio" name="payment" value="gcash" />
                                    Gcash / PayMaya
                                </label>
                                <div class="expandable">
                                    <p>
                                        Send your payment directly to our gcash/paymaya account.
Number:
0917 874 8039
                                    </p>
                                </div>
                            </div>

                            <div class="radio-option">
                                <label>
                                    <input type="radio" name="payment" value="paypal" />
                                    Paypal
                                </label>
                                <div class="expandable">
                                    <p>
                                        We'll send an invoice with the invoice fee to your registered email.
You may
                                        also send the payment directly to order@otakuhobbitoysph.com as family and
                                        friends.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="" id="buynow">
                        <div>
                            <h2>Complete Order</h2>
                        </div>
                    </a>
                    <div id="popup">
                        <div class="popup-content">
                            <img src="projectimg/check.png" alt="Success" class="popup-icon" />
                            <p class="popup-text">Ordered Successfully</p>
                            <button id="okBtn">OK</button>
                        </div>
                    </div>
                </div>

                <div id="summary">
                    <div id="itemsummary">
                        <div class="item">
                            <div class="itempic">
                                <img src="projectimg/bronya-1.jpg" alt="" />
                            </div>
                            <div class="iteminfo">
                                <h5>Honkai Impact 3rd Bronya Herrscher of Reason Ver. 1/8 Complete Figure</h5>
                                <p><b>Price: </b> ₱16,840</p>
                            </div>
                            <div class="amountspinner">
                                <form class="number-spinner-horizontal t-neutral">
                                    <fieldset class="spinner spinner--horizontal l-contain--medium">
                                        <button
                                            class="spinner__button spinner__button--left js-spinner-horizontal-subtract"
                                            data-type="subtract"
                                            title="Subtract 1"
                                            aria-controls="spinner-input">
                                            -
                                        </button>
                                        <input
                                            type="number"
                                            class="spinner__input js-spinner-input-horizontal"
                                            value="1"
                                            min="0"
                                            max="5"
                                            step="1"
                                            pattern="[0-9]*"
                                            role="alert"
                                            aria-live="assertive" />
                                        <button
                                            class="spinner__button spinner__button--right js-spinner-horizontal-add"
                                            data-type="add"
                                            title="Add 1"
                                            aria-controls="spinner-input">
                                            +
                                        </button>
                                    </fieldset>
                                </form>
                            </div>
                            <div class="delete">
                                <img src="projectimg/trash-bin.png" alt="" />
                            </div>
                        </div>
                    </div>
                    <div id="pricesummary">
                        <div class="summary-row">
                            <span>Sub Total:</span>
                            <span>₱16,840</span>
                        </div>
                        <div class="summary-row">
                            <span>Shipping Fee:</span>
                            <span>₱0</span>
                        </div>
                        <div class="summary-row total">
                            <span>Total:</span>
                            <span>₱16,840</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="footer"></div>
        <script src="checkout.js" type="text/javascript"></script>
    </body>
</html>
