---
title: Small Setting Triples Throughput
author: bobbyearl
layout: post
permalink: /2010/03/small-setting-triples-bandwidth/
categories:
  - Technology
tags:
  - Comcast
  - Extreme 50
  - Networking
  - RVS4000
---
After jumping through many hoops with Comcast, I recently upgraded to the Extreme 50 package, claiming to offer 50 Mbps download speeds. First step was to purchase a new modem supporting DOCSIS 3.0. I got a great deal on the Motorola SB6120 from BestBuy thanks to some price matching. Looks like Amazon would&#8217;ve been the best bet otherwise.  Step two was to take back my Cisco Small Business RVS4000 from a friend.  I get everything back home, hooked up and immediately start testing at <a href="http://speedtest.net" target="_blank">http://speedtest.net</a> and <a href="http://broadband.gov" target="_blank">http://broadband.gov</a>

The best I can get is around 20 Mbps out of Atlanta.  Definitely not the 50 I was hoping and paying for.  Several days go by of me chalking it up to Comcast&#8217;s over-hype of their ability.  A friend/coworker (Shameless plug for his website &#8211; <a href="http://buildegg.com" target="_blank">BuildEgg</a>) suggests the router is probably the bottleneck.  My friend&#8217;s solution to his underpowered networking hardware was to build his own router using <a href="http://www.pfsense.com/" target="_blank">pfSense</a>.  Trying to explore cheaper options first I do a quick Google search and find a suggestion to disable the IPS.

Disabling the IPS and a quick reboot immediately yield results around 60 Mbps.  Woohoo.

<div id="attachment_190" style="width: 310px" class="wp-caption aligncenter">
  <a rel="lightbox" href="{{ '/assets/img/blog/wp-content/' | append: site.baseurl }}uploads/2010/03/speedtest.jpg"><img class="size-medium wp-image-190 " title="Speed Test - 60 Mbps" src="{{ '/assets/img/blog/wp-content/' | append: site.baseurl }}uploads/2010/03/speedtest-300x188.jpg" alt="Speed Test - 60 Mbps" width="300" height="188" /></a>
  
  <p class="wp-caption-text">
    Speed Test Results
  </p>
</div>

<p style="text-align: center;">
  <p style="text-align: center;">
    <p>
      Simply disabling the IPS feature nearly tripled my throughput.  I honestly have no idea if there are any other ramifications for doing this, but at this point I don&#8217;t care.  I&#8217;m also only getting around 4 Mbps upload speeds versus the advertised 10, but I&#8217;ll save that one for another day.  In any case I felt I can&#8217;t be the only other poor sap who&#8217;s getting horrible speeds, just because of their poorly performing router.
    </p>