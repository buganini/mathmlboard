<?php
$head="Help Document";
include_once("config.php");
head();
?>
<table><tr align="left"><td width="800">
<a name="top"></a>
1. <a href="#h1">About this board</a><br />
2. <a href="#h2">Attention</a><br />
3. <a href="#h3">What is MathML?</a><br />
4. <a href="#h4">How to generate MathML?</a><br />
5. <a href="#h5">Support browser</a><br />
6. <a href="#h6">Thanks to</a><br />
<hr />
<a name="h1"></a>
<h3>About this board</h3>
<pre>
This board is called Bug's MathML Board.
But, I hope it is without bug.......XD

				--gmobug 2004.09.26
</pre>
<p align="center">[<a href="#top">Top</a>]</p>
<a name="h2"></a>
<h3>Attention</h3>
Any &lt;, &gt; outside &lt;math&gt;, &lt;/math&gt; will be translated to &amp;lt;, &amp;gt;.<br /><br />
To make a hyper-link, you can use [link]http://....[/link].<br /><br />
To paste a picture, you can use [img]http://....[/img].<br /><br />
The DTD included is very strict (only read.php include it), so you should be carefull when you replying or creating a new topic, or the page may not pass the strict regular.<br /><br />
I have made program do some preprocess to prevent mistakes.<br /><br />
If you have made the mistake, you can append "&safe_mod=1" at the end of URL, this way, server will not sent content-type as XML, and then you can fix the code.
<br /><br />
<p align="center">[<a href="#top">Top</a>]</p>
<a name="h3"></a>
<h3>What is MathML?</h3>
MathML is intended to facilitate the use and re-use of mathematical and scientific content on the Web, and for other applications such as computer algebra systems, print typesetting, and voice synthesis. MathML can be used to encode both the presentation of mathematical notation for high-quality visual display, and mathematical content, for applications where the semantics plays more of a key role such as scientific software or voice synthesis.
<br /><br />
MathML is cast as an application of XML. As such, with adequate style sheet support, it will ultimately be possible for browsers to natively render mathematical expressions. For the immediate future, several vendors offer applets and plug-ins which can render MathML in place in a browser. Translators and equation editors which can generate HTML pages where the math expressions are represented directly in MathML will be available soon.
<br /><pre>
					--<a href="http://www.w3.org/Math/whatIsMathML.html">http://www.w3.org/Math/whatIsMathML.html</a></pre>

<p align="right"><a href="http://www.w3.org/Math/">(more about MathML)</a></p><br />
<p align="center">[<a href="#top">Top</a>]</p>
<a name="h4"></a>
<h3>How to generate MathML?</h3>
Under windows, I know some softwares can do.
<pre>
	1.MathType	(shareware)
	2.OpenMathEdit	(freeware, opensource)	<a href="http://openmathedit.sourceforge.net">http://openmathedit.sourceforge.net</a>
</pre>
<br />And Mathematica, Matlab...etc. are able to export MathML, too.<br />
<br />Another way, you can generate MathML on-line from <a href="http://www.terradotta.com/index.cfm?FuseAction=MathIWYG.Demo" target="_blank">here</a>. Your browser should be able to support flash.<br />
<br />I have never do this under UNIX like system, but OpenMathEdit should be able to do it, beacuse it's opensource.<br />
<br />If you use MathType, you should change setting [Preferences/Translators], choose the option "Translation to other language (text)", and choose "MathML 2.0" from list to be your translator.<br />
<br />If you use OpenMathEdit, change setting [Select the default Clipboard copy format:] to "MathML - For XHTML editing".<br /><br />
<p align="center">[<a href="#top">Top</a>]</p>
<a name="h5"></a>
<h3>Support browser</h3>
The Bug's MathML Board has been finished testing via:
<pre>
	1. IE 6.0
	2. Mozilla 1.5
	3. Mozilla Firebird 0.6.1
	4. Epiphany 1.2.3
</pre>
Comment: Mozilla Firebird, Epiphany are based on Mozilla, similar to Mozilla, they need some fonts for MathML.<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; When I tested via Konqueror 3.2.2, there is a parser error, but I don't know how to fix it. Anyone can help me?

<p align="center">[<a href="#top">Top</a>]</p>
<a name="h6"></a>
<h3>Thanks to</h3>
<pre>
Thanks to:
<a href="mailto:paul@activemath.org">Paul Libbrecht</a> and <a href="mailto:Robert@dessci.com">Robert Miner</a>
in <a href="mailto:www-math@w3.org">W3 MathML mailing list</a>.
They replied my questions so that I could solve some problems about MathML.

FIEND from <a href="http://www.twbb.org/forum">http://www.twbb.org/forum</a>
He tought me about regular expression.
</pre>
<p align="center">[<a href="#top">Top</a>]</p>
</td></tr></table>
<?
tail();
?>