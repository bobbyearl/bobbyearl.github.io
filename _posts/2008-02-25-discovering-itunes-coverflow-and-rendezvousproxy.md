---
title: Discovering iTunes, CoverFlow and RendezvousProxy
author: bobbyearl
layout: post
permalink: /2008/02/discovering-itunes-coverflow-and-rendezvousproxy/
aktt_notify_twitter:
  - no
categories:
  - Technology
---
I briefly used iTunes in the past, but was never really impressed. I&#8217;ve consistently used Windows Media Player for quite some time now. There may have even been a brief stint with Winamp. Perhaps the only reason I stuck with WMP was it was already bundled with the PC. While helping Clay finally setup his computer this weekend, I took a peek at his music library. I&#8217;d seen CoverFlow on the iPhone, but just assumed you couldn&#8217;t use it on Windows. Guess that&#8217;s what I get for assuming.

<img class="aligncenter size-full wp-image-179" title="coverflow" src="{{ '/assets/img/blog/wp-content/' | append: site.baseurl }}uploads/2009/01/coverflow.gif" alt="coverflow" width="502" height="152" />

I immediately set it up to share music. Only problem there is you can&#8217;t use CoverFlow when looking at a shared library. When I got to work I got excited thinking about all the possible libraries out there. To my shagrin I couldn&#8217;t see a single shared library. While I&#8217;m not a network expert, I&#8217;m pretty sure it&#8217;s due to the limitations of zerconf and subnets. Maybe not limitations, but intentional design.

Using RendezvousProxy I was able to at least view my home library, via a tutorial. It works perfectly when selecting individual songs, but when set to shuffle iTunes will hang at the end of the first song. I&#8217;m still hoping to be able to access shared libraries on the campus.