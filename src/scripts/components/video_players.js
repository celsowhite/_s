/*================================= 
Imports
=================================*/

import fitvids from 'fitvids';
import plyr from 'plyr';

/*================================= 
Plyr - Custom youtube, vimeo and html5 video skin
https://github.com/sampotts/plyr
=================================*/

const player = new plyr('#player');

/*================================= 
Fitvids
=================================*/

// Wrap All Iframes with 'video_embed' for responsive videos.
// Loaded after plyr setup so it doesn't double wrap with padding-top/bottom.

$('iframe[src*="youtube.com"], iframe[src*="vimeo.com"]').wrap("<div class='video_embed'/>");

// Target div for fitVids

fitvids('.video_embed');