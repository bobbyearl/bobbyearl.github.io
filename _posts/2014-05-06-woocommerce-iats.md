---
title: WooCommerce iATS Payment Gateway
---

In my current role at Blackbaud, I've been fortunate enough to create some fun and challenging customizations.  As Wordpress has became a staple offering for the <a href="https://www.blackbaud.com/online-marketing/web-design" target="_blank">Interactive Services</a> team, we found the need to create a WooCommerce plugin, adding iATS as a Payment Gateway.

Our client, <a href="http://www.adra.ca" target="_blank">ADRA Canada</a> was already an iATS customer, and didn't want to have to switch merchants or use a second one just for their ecommerce store.  A quick search revealed an active developer community, including payment gateways for WooCommerce, but sadly, not one for use <a href="http://ideas.woothemes.com/forums/133476-woocommerce/suggestions/3634815-add-iats-as-a-payment-gateway" target="_blank">with iATS</a>.

The last piece to confirm was that iATS provided an API to interactive with.  Another quick search shows they provide a <a href="http://home.iatspayments.com/products/web-service" target="_blank">Web Service for developers</a> service.  A few weeks scoping and several email exchanges later with the iATS staff and our client, we had our scope!

![iATS Payment Gateway]({{ site.baseurl }}/assets/img/blog/woocommerce-iats.png)

While I'm not able to provide all the technical details of the project, the iATS Web Service and <a href="http://docs.woothemes.com/wc-apidocs/class-WC_Payment_Gateways.html" target="_blank">WooCommerce API</a> were both very well documented and easy to work with.  The end product is a fully functioning <a href="http://www.adra.ca/giftcatalogue/" target="_blank">eCommerce store</a> with support for the iATS payment gateway!  If you find yourself in a similar situation, don't hesitate to <a href="mailto:bobby.earl@blackbaud.com">contact me</a>.