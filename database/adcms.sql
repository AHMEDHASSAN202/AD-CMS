-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2017 at 10:31 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.5.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adcms`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `link` text NOT NULL,
  `image` text NOT NULL,
  `start_at` int(11) NOT NULL,
  `end_at` int(11) NOT NULL,
  `page` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(40) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created` varchar(12) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `description`, `created`, `status`) VALUES
(1, NULL, 'marketing', 'This Category Specified To Marketing.', '1504924021', 1),
(6, 0, 'news', '', '1505015013', 1),
(7, 6, 'alyoum 7', NULL, '1505015110', 1),
(8, 6, 'el watan', NULL, '1505015158', 1),
(9, 0, 'fashion', '', '1505015216', 0),
(11, 9, 'Clothes', NULL, '1505073590', 1),
(12, 9, 'shoes', NULL, '1505075616', 0),
(13, 0, 'cooking', NULL, '1505254208', 1),
(14, NULL, 'Artificial intelligence', NULL, '1505254351', 0),
(15, 0, 'programming', NULL, '1505254443', 1),
(16, 15, 'php', NULL, '1505254464', 1),
(21, 15, 'java', '', '1505255531', 1),
(23, 13, 'Pizza hut', 'Pizza Hut WOW !!! ', '1505444698', 1),
(24, 9, 'T Shirt', NULL, '1505527891', 1),
(26, 15, 'JS', '', '1505613436', 1),
(32, 0, 'sporting', 'this category for sporting', '1506019644', 1),
(33, 32, 'Zamalek', 'This is beautiful club ', '1506019760', 1),
(34, 32, 'ahly', 'hhhhhhhhhhhh', '1506019775', 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created` int(11) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(96) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `created` int(11) NOT NULL,
  `reply` text NOT NULL,
  `replied_by` int(11) NOT NULL,
  `replied_at` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `online_users`
--

CREATE TABLE `online_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `details` text NOT NULL,
  `image` text NOT NULL,
  `tags` varchar(255) NOT NULL,
  `related_posts` text NOT NULL,
  `views` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `status` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `category_id`, `user_id`, `title`, `details`, `image`, `tags`, `related_posts`, `views`, `created`, `status`) VALUES
(5, 16, 8, 'The MVC Pattern and PHP, Part 1', '<p>The Model-View-Control (MVC) pattern, originally formulated in the late 1970s, is a software architecture pattern built on the basis of keeping the presentation of data separate from the methods that interact with the data. In theory, a well-developed MVC system should allow a front-end developer and a back-end developer to work on the same system without interfering, sharing, or editing files either party is working on.</p>\r\n<p>Even though MVC was originally designed for personal computing, it has been adapted and is widely used by web developers due to its emphasis on separation of concerns, and thus indirectly, reusable code. The pattern encourages the development of modular systems, allowing developers to quickly update, add, or even remove functionality.</p>\r\n<p>In this article, I will go the basic principles of MVC, a run through the definition of the pattern and a quick example of MVC in PHP. This is definitely a read for anyone who has never coding with MVC before or those wanting to brush up on previous MVC development skills.</p>\r\n<p>&nbsp;</p>\r\n<h2>Understanding MVC</h2>\r\n<p>The pattern&rsquo;s title is a collation of its three core parts: Model, View, and Controller. A visual representation of a complete and correct MVC pattern looks&nbsp;<strong><span style="color: #33cccc;"><a style="color: #33cccc;" title="MVC-Process" href="http://en.wikipedia.org/wiki/File:MVC-Process.png" target="_blank">like the following diagram</a></span></strong>:</p>\r\n<p style="text-align: center;"><img src="https://dab1nmslvvntp.cloudfront.net/wp-content/uploads/2013/03/MVC-Process.png" alt="MVC " width="320" height="350" /></p>\r\n<p style="text-align: left;">&nbsp;</p>\r\n<p style="text-align: left;">The image shows the single flow layout of data, how it&rsquo;s passed between each component, and finally how the relationship between each component works.</p>\r\n<p style="text-align: left;">&nbsp;</p>\r\n<h2>Model</h2>\r\n<p>The Model is the name given to the permanent storage of the data used in the overall design. It must allow access for the data to be viewed, or collected and written to, and is the bridge between the View component and the Controller component in the overall pattern.</p>\r\n<p>One important aspect of the Model is that it&rsquo;s technically &ldquo;blind&rdquo; &ndash; by this I mean the model has no connection or knowledge of what happens to the data when it is passed to the View or Controller components. It neither calls nor seeks a response from the other parts; its sole purpose is to process data into its permanent storage or seek and prepare data to be passed along to the other parts.</p>\r\n<p>The Model, however, cannot simply be summed up as a database, or a gateway to another system which handles the data process. The Model must act as a gatekeeper to the data itself, asking no questions but accepting all requests which comes its way. Often the most complex part of the MVC system, the Model component is also the pinnacle of the whole system since without it there isn&rsquo;t a connection between the Controller and the View.</p>\r\n<p>&nbsp;</p>\r\n<h3>View</h3>\r\n<p>The View is where data, requested from the Model, is viewed and its final output is determined. Traditionally in web apps built using MVC, the View is the part of the system where the HTML is generated and displayed. The View also ignites reactions from the user, who then goes on to interact with the Controller. The basic example of this is a button generated by a View, which a user clicks and triggers an action in the Controller.</p>\r\n<p>There are some misconceptions held about View components, particularly by web developers using the MVC pattern to build their application. For example, many mistake the View as having no connection whatsoever to the Model and that all of the data displayed by the View is passed from the Controller. In reality, this flow disregards the theory behind the MVC pattern completely. Fabio Cevasco&rsquo;s article&nbsp;<strong><span style="color: #33cccc;"><a style="color: #33cccc;" title="The CakePHP Framework: Your First Bite" href="http://www.sitepoint.com/application-development-cakephp/">The CakePHP Framework: Your First Bite</a></span></strong>demonstrates this confused approach to MVC in the CakePHP framework, an example of the many non-traditional MVC PHP frameworks available:</p>\r\n<p>&nbsp;</p>\r\n<blockquote>\r\n<p><strong><sub>&ldquo;<em>It is important to note that in order to correctly apply the MVC architecture, there must be no interaction between models and views: all the logic is handled by controllers&ldquo;</em></sub></strong></p>\r\n</blockquote>\r\n<p>Furthermore, the description of Views as a template file is inaccurate. However, as Tom Butler points out, this is not one person&rsquo;s fault but a multitude of errors by a multitude of developers which result in developers learning MVC incorrectly. They then go on to educate others incorrectly. The View is really much more than just a template, however modern MVC inspired frameworks have bastardised the view almost to the point that no one really cares whether or not a framework actually adheres to the correct MVC pattern or not.</p>\r\n<p>It&rsquo;s also important to remember that the View part is never given data by the Controller. As I mentioned when discussing the Model, there is no direct relationship between the View and the Controller without the Model in between them.</p>\r\n<p>&nbsp;</p>\r\n<h3>Controller</h3>\r\n<p>The final component of the triad is the Controller. Its job is to handle data that the user inputs or submits, and update the Model accordingly. The Controller&rsquo;s life blood is the user; without user interactions, the Controller has no purpose. It is the only part of the pattern the user should be interacting with.</p>\r\n<p>The Controller can be summed up simply as a collector of information, which then passes it on to the Model to be organized for storage, and does not contain any logic other than that needed to collect the input. The Controller is also only connected to a single View and to a single Model, making it a one way data flow system, with handshakes and signoffs at each point of data exchange.</p>\r\n<p>It&rsquo;s important to remember the Controller is only given tasks to perform when the user interacts with the View first, and that each Controller function is a trigger, set off by the user&rsquo;s interaction with the View. The most common mistake made by developers is confusing the Controller for a gateway, and ultimately assigning it functions and responsibilities that the View should have (this is normally a result of the same developer confusing the View component simply as a template). Additionally, it&rsquo;s a common mistake to give the Controller functions that give it the sole responsibility of crunching, passing, and processing data from the Model to the View, whereas in the MVC pattern this relationship should be kept between the Model and the View.</p>\r\n<p><strong><sub><em>&nbsp;</em></sub></strong></p>', 'public/uploads/images/posts/f1f5b9fed82430d611f6bc7a1883fc14ed2ecdd0561ce0509c80969ecb283177ce269d9ae8be0459.jpg', '#php #mvc', 'N;', 0, 1506293295, 1),
(6, 26, 8, 'To Redux or Not: the Art of Structuring ', '<p><strong>One common trend I find among most Redux developers is a hatred towards&nbsp;<code class=" language-jsx"><span class="token function">setState</span><span class="token punctuation">(</span><span class="token punctuation">)</span></code>. A lot of us (yes, I&rsquo;ve fallen into this trap many times before) flinch at the sight of<span style="background-color: #ebebeb;">&nbsp;<code class=" language-jsx"><span class="token function" style="color: #ff0000;">setState</span><span class="token punctuation">(</span><span class="token punctuation">)</span></code></span>&nbsp;and try to keep all the data in our Redux store. But, as the complexity of your application grows, this poses several challenges.</strong></p>\r\n<p>&nbsp;</p>\r\n<p>In this post, I&rsquo;ll walk you through various strategies to model your state, and dive into when each of them can be used.</p>\r\n<p>&nbsp;</p>', 'public/uploads/images/posts/9beb6464991418d7d1c8a7b03dc4c1ba2879349403a4166c2b795accd8d2a28800b06a2b9cc762fd.png', '#js', '', 0, 1506296385, 1),
(7, 16, 8, '9 Magic Methods in PHP', '<p><em>his post forms part of a series of articles about using PHP to do objected oriented programming, or OOP. They were originally published elsewhere but are no longer available at that location, so I''m reposting them here. Previously in the series was an introduction to OOP in PHP, in&nbsp;<span style="color: #008080;"><strong><a style="color: #008080;" title="Introduction to PHP OOP" href="http://lornajane.net/posts/2012/introduction-to-php-oop">two</a>&nbsp;<a style="color: #008080;" title="A Little More OOP in PHP" href="http://lornajane.net/posts/2012/a-little-more-oop-in-php">parts</a></strong></span></em></p>\r\n<p>&nbsp;</p>\r\n<p>The title is a bit of a red herring as PHP has more than 9 magic methods, but these will get you off to a good start using PHP''s&nbsp;<span style="color: #008080;"><strong><a style="color: #008080;" href="https://php.net/manual/en/language.oop5.magic.php">magic methods</a>. </strong></span>It might be magic, but no wands are required!</p>\r\n<p>The "magic" methods are ones with special names, starting with two underscores, which denote methods which will be triggered in response to particular PHP events. That might sound slightly automagical but actually it''s pretty straightforward, we already saw an example of this in the&nbsp;<strong><span style="color: #008080;"><a style="color: #008080;" title="A Little More OOP in PHP" href="http://lornajane.net/posts/2012/a-little-more-oop-in-php">last post</a>,</span></strong> where we used a constructor - so we''ll use this as our first example.</p>\r\n<p>&nbsp;</p>\r\n<h2>__construct</h2>\r\n<p>The constructor is a magic method that gets called when the object is instantiated. It is usually the first thing in the class declaration but it does not need to be, it a method like any other and can be declared anywhere in the class. Constructors also inherit like any other method. So if we consider our previous inheritance example from the Introduction to OOP, we could add a constructor to the Animal class like this.</p>\r\n<div lang="php">\r\n<pre lang="php">class Animal{\r\n\r\n  public function __construct() {\r\n    $this-&gt;created = time();\r\n    $this-&gt;logfile_handle = fopen(''/tmp/log.txt'', ''w'');\r\n  }\r\n\r\n}<br /><br /></pre>\r\n<p>Now we can create a class which inherits from the Animal class - a Penguin! Without adding anything into the Penguin class, we can declare it and have it inherit from Animal, like this:</p>\r\n<pre lang="php">class Penguin extends Animal {\r\n\r\n}\r\n\r\n$tux = new Penguin;\r\necho $tux-&gt;created;\r\n</pre>\r\n<p>If we define a&nbsp;<code>__construct</code>&nbsp;method in the Penguin class, then Penguin objects will run that instead when they are instantiated. Since there isn''t one, PHP looks to the parent class definition for information and uses that. So we can override, or not, in our new class - very handy.</p>\r\n<p>&nbsp;</p>\r\n<h3>__destruct</h3>\r\n<p>Did you spot the file handle that was also part of the constructor? We don''t really want to leave things like that lying around when we finish using an object and so the&nbsp;<code>__destruct</code>&nbsp;method does the opposite of the constructor. It gets run when the object is destroyed, either expressly by us or when we''re not using it any more and PHP cleans it up for us. For the Animal, our&nbsp;<code>__destruct</code>&nbsp;method might look something like this:</p>\r\n<pre lang="php">class Animal{\r\n\r\n  public function __construct() {\r\n    $this-&gt;created = time();\r\n    $this-&gt;logfile_handle = fopen(''/tmp/log.txt'', ''w'');\r\n  }\r\n\r\n  public function __destruct() {\r\n    fclose($this-&gt;logfile_handle);\r\n  }\r\n}\r\n</pre>\r\n<p>The destructor lets us close up any external resources that were being used by the object. In PHP since we have such short running scripts (and look out for greatly improved garbage collection in newer versions), often issues such as memory leaks aren''t a problem. However it''s good practice to clean up and will give you a more efficient application overall!</p>\r\n<h3>__get</h3>\r\n<p>This next magic method is a very neat little trick to use - it makes properties which actually don''t exist appear as if they do. Let''s take our little penguin:</p>\r\n<pre lang="php">class Penguin extends Animal {\r\n\r\n  public function __construct($id) {\r\n    $this-&gt;getPenguinFromDb($id);\r\n  }\r\n\r\n  public function getPenguinFromDb($id) {\r\n    // elegant and robust database code goes here\r\n  }\r\n}\r\n</pre>\r\n<p>Now if our penguin has the properties "name" and "age" after it is loaded, we''d be able to do:</p>\r\n<pre lang="php">$tux = new Penguin(3);\r\necho $tux-&gt;name . " is " . $tux-&gt;age . " years old\\n";\r\n</pre>\r\n<p>However imagine something changed about the backend database or information provider, so instead of "name", the property was called "username". And imagine this is a complex application which refers to the "name" property in too many places for us to change. We can use the&nbsp;<code>__get</code>&nbsp;method to pretend that the "name" property still exists:</p>\r\n<pre lang="php">class Penguin extends Animal {\r\n\r\n  public function __construct($id) {\r\n    $this-&gt;getPenguinFromDb($id);\r\n  }\r\n\r\n  public function getPenguinFromDb($id) {\r\n    // elegant and robust database code goes here\r\n  }\r\n\r\n  public function __get($field) {\r\n    if($field == ''name'') {\r\n      return $this-&gt;username;\r\n    }\r\n}\r\n</pre>\r\n<p>This technique isn''t really a good way to write whole systems, because it makes code hard to debug, but it is a very valuable tool. It can also be used to only load properties on demand or show calculated fields as properties, and a hundred other applications that I haven''t even thought of!</p>\r\n<h3>__set</h3>\r\n<p>So we updated all the calls to&nbsp;<code>$this-&gt;name</code>&nbsp;to return&nbsp;<code>$this-&gt;username</code>&nbsp;but what about when we want to set that value, perhaps we have an account screen where users can change their name? Help is at hand in the form of the&nbsp;<code>__set</code>method, and easiest to illustrate with an example.</p>\r\n<pre lang="php">class Penguin extends Animal {\r\n\r\n  public function __construct($id) {\r\n    $this-&gt;getPenguinFromDb($id);\r\n  }\r\n\r\n  public function getPenguinFromDb($id) {\r\n    // elegant and robust database code goes here\r\n  }\r\n\r\n  public function __get($field) {\r\n    if($field == ''name'') {\r\n      return $this-&gt;username;\r\n    }\r\n  }\r\n\r\n  public function __set($field, $value) {\r\n    if($field == ''name'') {\r\n      $this-&gt;username = $value;\r\n    }\r\n  }\r\n}\r\n\r\n</pre>\r\n<p>In this way we can falsify properties of objects, for any one of a number of uses. As I said, not a way to build a whole system, but a very useful trick to know.</p>\r\n<h3>__call</h3>\r\n<p>There are actually two methods which are similar enough that they don''t get their own title in this post! The first is the&nbsp;<code>__call</code>&nbsp;method, which gets called, if defined, when an undefined method is called on this object. The second is&nbsp;<code>__callStatic</code>&nbsp;which behaves in exactly the same way but responds to undefined static method calls instead (this was added in PHP 5.3). Probably the most common thing I use&nbsp;<code>__call</code>&nbsp;for is polite error handling, and this is especially useful in library code where other people might need to be integrating with your methods. So for example if a script had a Penguin object called $penguin and it contained&nbsp;<code>$penguin-&gt;speak()</code>&nbsp;... the&nbsp;<code>speak()</code>&nbsp;method isn''t defined so under normal circumstances we''d see:</p>\r\n<p><code><br />PHP Fatal error: Call to undefined method Penguin::speak() in ...<br /></code></p>\r\n<p>What we can do is add something to cope more nicely with this kind of failure than the PHP fatal error you see here, by declaring a method&nbsp;<code>__call</code>. For example:</p>\r\n<pre lang="php">class Animal {\r\n}\r\nclass Penguin extends Animal {\r\n\r\n  public function __construct($id) {\r\n    $this-&gt;getPenguinFromDb($id);\r\n  }\r\n\r\n  public function getPenguinFromDb($id) {\r\n    // elegant and robust database code goes here\r\n  }\r\n\r\n  public function __get($field) {\r\n    if($field == ''name'') {\r\n      return $this-&gt;username;\r\n    }\r\n  }\r\n\r\n  public function __set($field, $value) {\r\n    if($field == ''name'') {\r\n      $this-&gt;username = $value;\r\n    }\r\n  }\r\n\r\n  public function __call($method, $args) {\r\n      echo "unknown method " . $method;\r\n      return false;\r\n  }\r\n}\r\n</pre>\r\n<p>This will catch the error and echo it. In a practical application it might be more appropriate to log a message, redirect a user, or throw an exception, depending on what you are working on - but the concept is the same. Any misdirected method calls can be handled here however you need to, you can detect the name of the method and respond differently accordingly - for example you could handle method renaming in a similar way to how we handled the property renaming above.</p>\r\n<h3>__sleep</h3>\r\n<p>The&nbsp;<code>__sleep()</code>&nbsp;method is called when the object is serialised, and allows you to control what gets serialised. There are all sorts of applications for this, a good example is if an object contains some kind of pointer, for example a file handle or a reference to another object. When the object is serialised and then unserialised then these types of references are useless since the target may no longer be present or valid. Therefore it is better to unset these before you store them.</p>\r\n<h3>__wakeup</h3>\r\n<p>This is the opposite of the&nbsp;<code>__sleep()</code>&nbsp;method and allows you to alter the behaviour of the unserialisation of the object. Used in tandem with&nbsp;<code>__sleep()</code>, this can be used to reinstate handles and object references which were removed when the object was serialised. A good example application could be a database handle which gets unset when the item is serialised, and then reinstated by referring to the current configuration settings when the item is unserialised.</p>\r\n<h3>__clone</h3>\r\n<p>We looked at an example of using the&nbsp;<code>clone</code>&nbsp;keyword in the&nbsp;<strong><span style="color: #008080;"><a style="color: #008080;" title="A Little More OOP in PHP" href="http://lornajane.net/posts/2012/a-little-more-oop-in-php">second part</a>&nbsp;</span></strong>of my introduction to OOP in PHP, to make a copy of an object rather than have two variables pointing to the same actual data. By overriding this method in a class, we can affect what happens when the clone keyword is used on this object. While this isn''t something we come across every day, a nice use case is to create a true singleton by adding a private access modifier to the method.</p>\r\n<h3>__toString</h3>\r\n<p>Definitely saving the best until last, the&nbsp;<code>__toString</code>&nbsp;method is a very handy addition to our toolkit. This method can be declared to override the behaviour of an object which is output as a string, for example when it is echoed. For example if you wanted to just be able to echo an object in a template, you can use this method to control what that output would look like. Let''s look at our Penguin again:</p>\r\n<pre lang="php">class Penguin {\r\n\r\n  public function __construct($name) {\r\n      $this-&gt;species = ''Penguin'';\r\n      $this-&gt;name = $name;\r\n  }\r\n\r\n  public function __toString() {\r\n      return $this-&gt;name . " (" . $this-&gt;species . ")\\n";\r\n  }\r\n}\r\n</pre>\r\n<p>With this in place, we can literally output the object by calling echo on it, like this:</p>\r\n<pre lang="php">$tux = new Penguin(''tux'');\r\necho $tux;\r\n</pre>\r\n<p>I don''t use this shortcut often but it''s useful to know that it is there.</p>\r\n<h3>More Magic Methods</h3>\r\n<p>There is a&nbsp;<span style="color: #008080;"><a style="color: #008080;" href="https://php.net/manual/en/language.oop5.magic.php"><strong>great reference on the php.net site</strong>&nbsp;</a></span>itself, listing all the available magic methods (yes, there are more than these, I just picked the ones I thought were best to start with) so if you want to know what else is available then take the time to check this out.</p>\r\n<code><span style="background-color: #ebebeb;"><br /></span></code></div>', 'public/uploads/images/posts/27cf1f171344854ff26a6985f8b5f3fcb68cb471e69d9f24cab87e19f67da22c700c5db1f54a4c64.png', '#php #magic_method', 'a:1:{i:0;s:1:"5";}', 0, 1506299575, 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `key` varchar(100) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`) VALUES
(1, 'site_name', 'new blog'),
(2, 'site_status', '1'),
(3, 'site_email', 'ahmed@gmail.com'),
(4, 'site_close_msg', 'oops!! Sorry');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `users_group_id` int(11) NOT NULL DEFAULT '0',
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(96) NOT NULL,
  `password` varchar(250) NOT NULL,
  `birthday` varchar(100) NOT NULL,
  `gender` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created` varchar(50) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `confirm_id` varchar(200) NOT NULL,
  `verified` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `users_group_id`, `first_name`, `last_name`, `email`, `password`, `birthday`, `gender`, `status`, `created`, `ip`, `code`, `image`, `confirm_id`, `verified`) VALUES
(2, 3, 'mohammed', 'hassan', 'mohamed@gmail.com', '$2y$10$1syJs5c0QCHn3D6FwDHoeerYreLsT.rsI8qvfsfnRF5qrSIS2xm.G', '946854000', 1, 1, '1502378060', '127.0.0.1', '8e8de91dc91edfd463d91bb9663a3dba1be2a712', 'public/uploads/images/users/43214be8123611288aef339437fde8c5b852b79dc2c86a37088d72a4c4c13e4edb36aad7c7cf324a.jpg', '0', 1),
(3, 0, 'sayed', 'hassan', 'sayed@gmail.com', '$2y$10$j7pS7wBBSdhounYq1DevK.mP0GSS2ARV.tL.EXacrwSNWjfMsOHLi', '694738800', 1, 1, '1502410231', '127.0.0.1', '660a93448e702297663be4d424f45cc7fb005dbc', 'public/uploads/images/users/bcef2c44e9014ef4b52ebea00fa8cf3713e8b01063b1dfb5846affa9592e7d136dbe86b6165b121b.png', '0', 1),
(6, 0, 'osama', 'Gamal', 'osama_gamal@gmail.com', '$2y$10$v.BOmvOMWPa/58XkOwecIerbWih7YhKQ9xlzV3G5c9WlSG2U.0Tdi', '710287200', 1, 0, '1502492378', '127.0.0.1', '7cc4309ed536e926b2b7842828409c71d56b37a9', 'public/uploads/images/users/cff50dedad72b54bf1917da5147fc13b84dca713e214b3c7847dc5fd564b05ad6cc9c0ed8710c316.png', '0', 1),
(8, 1, 'ahmed', 'hassan', 'ahmed@gmail.com', '$2y$10$wqTpN52MHShLrkatVC6wSetMg.SEpyT/5AvvDgNR/eMmizI/m67eG', '817945200', 1, 1, '1503191486', '127.0.0.1', 'f08e74137d59f9a131ce3d18f703951427c5590a', 'public/uploads/images/users/051acf05429c0e40ecdb7f3d3a4dce69c97c1935_73755880e4d8662ea619f274e215c3f39c5c12b5.jpg', '0', 1),
(12, 3, 'maha', 'hassan', 'maha@gmail.com', '$2y$10$Fmz1O3ohr5vog1wsM5O14OC1o07GvTpwfEVc2Slfas14FRo9wQeda', '931384800', 0, 1, '1503414582', '127.0.0.1', 'c85c20ef54680db004cc9476085ef9cdbc1123ef', 'public/uploads/images/users/09d10331ef28d4f73fd5b31bce6cf4da5402849139c0f118fc0720cc3c03e0bc693e58d6128f7bbe.png', '0', 1),
(13, 2, 'ibrahim', 'mostafa', 'ibrahim@hotmail.com', '$2y$10$ZiAVQz9B9CblBN/WGE4uXuc40Dpxwa/yzyal4xiEJix2JZAbOQ8PS', '815871600', 1, 1, '1503414892', '127.0.0.1', 'aad260ac2c0edfe143cfb55e7e14a00a953595bc', 'public/uploads/images/users/7beafe4bdc4225f8ca1b9087dbba46cd5881965c42d8890db22fd3de128c0034002a799f220b26da.png', '0', 1),
(14, 0, 'ibrahim', 'mostafa', 'ibrahimhh@hotmail.com', '$2y$10$voGapbeWRL7mOtUFnlUiAudXReYETpe8qSaC3rr83nfGS28CfmYZS', '815871600', 0, 1, '1503415013', '127.0.0.1', '8e059c45c8a565c1955bf6a8bd8858e71852944c', 'public/uploads/images/users/7f7a77c3dbc14139db35a6932aa9530f78ac7d41af72da90e0cc3fd96382c1b0b2cf59b780c4b0d4.png', '0', 1),
(19, 0, 'esmail', 'hussain', 'aelmstkanis@gmail.comss', '$2y$10$ySYH7Jgo1luTUkp9B4ke3uXBfmrCIaYHmNeCUVpcp7EbfdHTccZD2', '934063200', 0, 1, '1503415770', '127.0.0.1', '641b9a33355c434a52331bee6b14d42444671c3e', 'public/uploads/images/users/b2e42ec4f7f3ff328477abcf58d5f6ec4aecd31b1f4568bceea043a7f7ebde3eb02af25ff64820e5.png', '0', 1),
(21, 0, 'mohamed', 'mahmoud', 'moha@gmail.com', '$2y$10$JnktimofZCZ8Si3Z89OB2uSwCLuvf3437d3JYDTh.3VwyqOwlI0je', '707954400', 1, 1, '1504098834', '127.0.0.1', '2a4f37bb8ce7a2c622073306e4629f010fabf8ff', 'public/uploads/images/users/7e278105c6147385ca99826263837cc7e6a420852571fc980c07b0585cd79c9cbc7b88bdaf15f7e8.jpg', '0', 1),
(24, 0, 'ananan', 'najshsdhd', 'ahmedhhhhh@gmail.com', '$2y$10$ae4HnZbbEuYximJhm7.ctuvGvRt.XIhKaQQAxjDEc22uQUU7b.c22', '934063200', 0, 0, '1504650566', '127.0.0.1', 'c39259c80fc6274e1b0b8120a45ec334973e1b17', 'public/uploads/images/users/a1bcb7ae272b7bcba8980388e5c40b3e2bd74f36f90841a70545bc56b5809dfef850451e3be08a8b.png', 'c1fcf641404cf58d2a5080775dc753b8', 0),
(25, 2, 'ssss', 'hhdhd', 'ahmeeeeeeg@gmaol.com', '$2y$10$xDpR7jb2GBoJhInBZCwkyug2GeYq7Tm7jq4Zcmt1e6QX8JXJse3/S', '902440800', 1, 1, '1504650635', '127.0.0.1', '00d1a680441830bb3a71aa4822859b516f27d0f0', 'public/uploads/images/users/23833de44c0a6c4c25f2649d9f868b98fe9b3d0839593b22c7b65b3a3fc4ee74b2d894cde185bbac.png', '0', 1),
(26, 3, 'ahhh', 'kjdjd', 'ahmfn@gmao.com', '$2y$10$xGBbueEmmRVXy6DogNXaNe6SW.qZs3bxgBG/.ShB7ymwcWuZNdLie', '-18061200', 1, 1, '1504650672', '127.0.0.1', '9368ccbfc873d59c9af0d06da2e5c297a379154d', 'public/uploads/images/users/59568a6d565d1673536cff10794b6c5e39f821c6b1e9316ec48007638267d0ac61d95543c7e1012c.png', '596d01b7a298db9aaf49226dea27dbb0', 0),
(27, 0, 'uuuuu', 'shjffnfb', 'iyiiuiuu@gm.dom', '$2y$10$ttAQA0hjD1textvzo2DVzO/xGI8ozO2cON7jazLQspLdhKXGUIrbO', '773532000', 0, 0, '1504650716', '127.0.0.1', '9e42da11753be1ca3cc2bca3d0defbd39e298817', 'public/uploads/images/users/cb88973bb2317b5517257fc6cd266c0bf1362db3063b580126f4e3a37a163fb49ac801eb99fb23df.png', '0', 1),
(28, 0, 'yuyu', 'opopo', 'opopop@gmail.com', '$2y$10$/6CbkplpD6qd2bxOnRL5t.Zuf0G5NJ4IKIgqvXXuqRYEaMMVcavOq', '881881200', 0, 0, '1504650753', '127.0.0.1', '2e0a5adc0f4d3141767f47b489c59afc1cf40348', 'public/uploads/images/users/400758d45c62b92f6441c32d1044e5789cbd53ff56b6550c2e913f7dcd8319fd45858bb96699a1fc.png', '0', 1),
(29, 0, 'mostada', 'mosta', 'mosta@gma.com', '$2y$10$4P6ktBwkL.SH22oryEqOzOJOL0QjvCQCp27TA7tP4D7SHfMh2kKI6', '685749600', 1, 1, '1504650833', '127.0.0.1', '5c88f0fe1400b7cfda1a5a41b39de05f584cca98', 'public/uploads/images/users/e16d9928ab29ccdcace43f99faf0b595d90ea9b81b98028a35fc405b092bc6e35a015e1227d2c160.png', '0', 1),
(34, 0, 'moooo', 'mohhhht', 'amoo@gmai.com', '$2y$10$e6kk0GwZFRbnEm95Gm8AfetyXQDkQq18gDMWWaC71A34YNl003eSa', '807746400', 1, 1, '1504653585', '127.0.0.1', 'e3de58c660d285aad29fd8fb53f7c66d8860a687', 'public/uploads/images/users/defaultMale.png', '0', 1),
(35, 0, 'hanaa', 'mohamed', 'hanaaa@gmai.com', '$2y$10$ilq/BoXtWf06XlXkr3cFO.Nns.NWpr0655R5/YNwtteLVmlgV2p86', '776296800', 0, 1, '1504653620', '127.0.0.1', '1269ac6bad519cae582de110efc6fa9d762b67a7', 'public/uploads/images/users/defaultFemale.png', '0', 1),
(36, 0, 'mohamdd', 'kskkssk', 'ahmed@fmal.odm', '$2y$10$h1T1ClLlDsJt0hCHQvOtlujjLR8KOXhWlF4cG8V1u.uqehdJK8kKq', '747439200', 1, 1, '1504653667', '127.0.0.1', '416ee629fe520d01dbc19055c2fbf7e8cc503dde', 'public/uploads/images/users/cf6008c4eeea3e905cea04b6370d3325ac7b9765f818da8b7a18b1f1769222dd0e26fca572f50afb.jpg', '0', 1),
(38, 0, 'bbbb', 'bggggg', 'ggggg@gmail.com', '$2y$10$edX7nRjWWMJeULEB3.dAEO4dKhr6xr1X./tVbh3AxQc1Qx24GYf4a', '807919200', 1, 1, '1506119326', '127.0.0.1', 'c675bb9625167d154217c7bda80101fed78e74ad', 'public/uploads/images/users/0a9fb112effbc80719b5290c5989726251742f9f7741982e84d798830f33c879a162f79b2c33ebc2.jpg', '367c3013c2e76973713e28cc6f0f965b', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_group`
--

CREATE TABLE `users_group` (
  `id` int(11) NOT NULL,
  `permission` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_group`
--

INSERT INTO `users_group` (`id`, `permission`) VALUES
(0, 'user'),
(1, 'adminstrator'),
(2, 'Publisher'),
(3, 'writer');

-- --------------------------------------------------------

--
-- Table structure for table `users_group_permissions`
--

CREATE TABLE `users_group_permissions` (
  `id` int(11) NOT NULL,
  `users_group_id` int(11) NOT NULL,
  `page` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online_users`
--
ALTER TABLE `online_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users_group`
--
ALTER TABLE `users_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_group_permissions`
--
ALTER TABLE `users_group_permissions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `online_users`
--
ALTER TABLE `online_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `users_group`
--
ALTER TABLE `users_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users_group_permissions`
--
ALTER TABLE `users_group_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
