<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('getCurrentDateTime')) {

	function getCurrentDatetime($format = "Y-m-d H:i:s") {
		return date($format);
	}

}

if (!function_exists('generatePassword')) {

	function generatePassword() {
		$length = 7;
		$alpha_numeric = 'abcdefghijklmnopqrstuvwxyz0123456789';
		return substr(str_shuffle($alpha_numeric), 0, $length);
	}

}

if (!function_exists('getUserName')) {

	function getUserName() {
		$CI = &get_instance(); //get instance, access the CI superobject
		$userId = $CI->session->userdata('logged_in')['user_id'];
		$CI->db->select('full_name');
		$CI->db->where('id', $userId);
		$query = $CI->db->get('user')->result();
		if (!empty($query)) {
			if (!empty($query[0]->full_name)) {
				return ucwords($query[0]->full_name);
			}
		}
		return 'Unknown User';
	}

}

if (!function_exists('messageAlert')) {

	function messageAlert() {
		$CI = &get_instance();
		if ($CI->session->flashdata('msg_success')) {
			?>
            <div class="alert alert-success message-alert"><?=$CI->session->flashdata('msg_success');?></div>
            <?php
}
		if ($CI->session->flashdata('msg_info')) {
			?>
            <div class="alert alert-info message-alert"><?=$CI->session->flashdata('msg_info');?></div>
            <?php
}
		if ($CI->session->flashdata('msg_warning')) {
			?>
            <div class="alert alert-warning message-alert"><?=$CI->session->flashdata('msg_warning');?></div>
            <?php
}
		if ($CI->session->flashdata('msg_error')) {
			?>
            <div class="alert alert-danger message-alert"><?=$CI->session->flashdata('msg_error');?></div>
            <?php
}
	}

}

if (!function_exists('generalEmail')) {

	function generalEmail($to, $from, $subject, $message) {
		echo $message;
		die;
		$CI = &get_instance();
		$CI->load->library('email', array('mailtype' => 'html'));
		$CI->email->from($from, "Performance360");
		$CI->email->to($to);
		$CI->email->subject($subject);
		$CI->email->message($message);
		if ($CI->email->send()) {
			return true;
		}
		show_error($this->email->print_debugger());
		die;
	}

}

if (!function_exists('getCURL')) {
	function getCURL($url) {

		if (!function_exists('curl_init')) {
			die('cURL is not installed. Install and try again.');
		}

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);

		$output = curl_exec($ch);
		curl_close($ch);

		return $output;
	}
}

if (!function_exists('checkBrowser')) {
	function checkBrowser() {
		$CI = &get_instance();
		$browser_name = $CI->agent->browser();
		$browser_version = ceil($CI->agent->version());

		if ($browser_name == "Chrome") {
			if ($browser_version >= 58) {
				return true;
			} else {
				die("You are Using old version of chrome. please update to latest version.");
			}
		} elseif ($browser_name == "Firefox") {
			if ($browser_version >= 52) {
				return true;
			} else {
				die("You are Using old version of Firefox. please update to latest version.");
			}
		} elseif ($browser_name == "Internet Explorer") {
			if ($browser_version >= 10) {
				return true;
			} else {
				die("You are Using old version of Internet Explorer. please update to latest version.");
			}
		} elseif ($browser_name == "Safari") {
			if ($browser_version >= 5) {
				return true;
			} else {
				die("You are Using old version of Internet Explorer. please update to latest version.");
			}
		} else {
			die("The internet browser you are using is not supported by our assessment platform. Please use Google Chrome, Firefox, Internet Explorer 10 or higher, or Safari.");
		}
	}
}

if (!function_exists('getTenamicsQuestions')) {
	function getTenamicsQuestions() {
		return array("I\'m extremely results driven",
			"I find it easy to concentrate for hours at a time",
			"I like to analyse things to check whether it\'s worth doing",
			"I need people around me at work",
			"I like to take the lead when working on projects",
			"I\'m seen as an enthusiastic person",
			"People sometimes think my ideas are strange",
			"I like to challenge the rule",
			"I\'m usually the one that shares information with others",
			"I usually adhere to procedures",
			"I\'ve got an outgoing attitude",
			"I like to network and build new relationships ",
			"I enjoy tasks that challenge me",
			"I tend to plan things very carefully",
			"Others describes me as a perfectionist",
			"I tend to give direct answers",
			"I prefer information to be structured",
			"I like work that allows me to have predictable outcomes",
			"I enjoy giving and receiving personal attention",
			"I prefer to work in supervision-free environments",
			"I am very detailed oriented and always spot errors quite easily",
			"I enjoy planning my day",
			"I\'m extremely goal-driven",
			"I like to prioritise my work",
			"I have a wide scope of interests",
			"I\'m not concerned with too much details",
			"People see me as critical when working on a problem",
			"I react quickly to change",
			"I tend to give direction when having to work in teams",
			"I see myself as a very analytical thinker",
			"I\'m usually the innovative one, coming up with new ways of thinking or doing things",
			"I prefer to work alone",
			"Others tend to ask me for advice when they are unsure of what to do on a project",
			"I like to reflect on new ideas",
			"I like to work in unpredictable environments",
			"I don\'t like to be office-bound and prefer to meet clients",
			"I dislike conflict",
			"I prefer a less social job",
			"There\'s only one way and that\'s the right way",
			"I enjoy being in contact with a variety of people",
			"I\'m extremely action orientated",
			"I\'m good at bringing stability in stressful times",
			"I have a destinct desire to help others",
			"I always check that my work is accurate",
			"Routine and structure is important to me",
			"I mostly comply to rules",
			"I see myself as a good listener",
			"I like to plan my activities well in advance to ensure I keep to my timelines",
			"I enjoy receiving public recognition",
			"I want security in my job",
			"I like to think more practical about things and asking whether it will actually work",
			"I like to plan for the long term",
			"Others look to me for guidance when working on difficult problems",
			"I prefer group activities",
			"I like to day-dream and think of ways to do my job completely different",
			"I\'m seen as very opportunistic",
			"My team sometimes asks me to be the spokesperson",
			"I seek out new activities",
			"I prefer not too much change",
			"I like coming up with creative ways to sell a product or service",
			"Give me detailed information",
			"I always seek facts",
			"I always dot the I\'s and cross the t\'s",
			"I\'m very considerate towards others",
			"I\'m seen as a stubborn individual",
			"I like to coordinate the activities to ensure I achieve all my objectives and targets",
			"I like to demontrate my ideas",
			"I have very strong opinions",
			"I like to bring stability in environments that constantly changes",
			"I try to avoid competitive jobs",
			"I always consider alternatives",
			"I like to be organised to help me plan more effectively",
			"I like researching things",
			"I prefer quality above speed",
			"I ask a lot of questions before accepting potential solutions",
			"I\'m a very logical thinking",
			"I like to influence and motivate the team to achieve bigger and better things",
			"I enjoy working in different territories",
			"I don\'t follow tradition at all, there\'s always a better or different way to approach things",
			"I enjoy explaining things to my team",
			"I\'m a very patient individual",
			"I enjoy challenging others",
			"I regularly read up on new trends to understand my clients better",
			"I enjoy motivating others",
			"I prefer predictable environments",
			"I like to meet new people",
			"I\'m usually calm under stressful times",
			"I always want to win",
			"I work very hard to deliver high quality solutions",
			"I tend to follow rules very carefully",
			"I enjoy a job that offers a lot of variety",
			"I like to maintain a constant work-flow to ensure my daily activities remains uninterrupted",
			"I need time to make decisions",
			"I prefer things above people",
			"I carefully consider all resources needed to ensure my work is not interrupted due to a lack of planning",
			"I prefer limited responsibilities",
			"I have a very unsystematic approach",
			"I like to test things or ideas to ensure it actually works in the real world",
			"I prefer low risk decisions",
			"I like to take charge of situations and delegate responsibilities to others",
			"I prefer to be very independent",
			"My ideas are sometimes described as strange",
			"I enjoy building and working in a climate that is relaxed and informal",
			"I like to be free from any rules at work",
			"I like to come up with creative and sometimes unusual ideas",
			"I have a sens of urgency",
			"I enjoy interacting with others",
			"I\'m extremely receptive to change",
			"I\'m seen as very open-minded",
			"I enjoy asking questions to understand my client\'s needs better",
			"I like to follow directions carefully",
			"I\'m probably a less cautious individual",
			"I\'m very quality orientated",
			"I always produce work of the highest standards",
			"I like repetitive work",
			"I enjoy competing",
			"I prefer environments that is not too fast-paced that forces me to keep changing or adapting",
			"I enjoy persuading people",
			"I\'m very quick to notice mistakes",
			"I work very hard to ensure I don\'t miss any deadlines",
			"I\'m driven for precision in my work",
			"I prefer to work from one place",
			"I tend to ask why a lot",
			"I listen to team members when they have ideas but ultimately take responsibility for making the final decision",
			"I\'m seen as a very patient individual",
			"I\'d rather talk to one person than to a group",
			"I see myself as very innovative",
			"I don\'t like it when someone disagrees with me");
	}
}

if (!function_exists('getBECIQuestions')) {
	function getBECIQuestions() {
		return array("I energetically pursue tasks I see as challenging",
			"I allow others the opportunity to speak",
			"I\'m very tolerant towards people who learn much slower than what I do",
			"I can negotiate skilfully",
			"I want to be the best",
			"I tend to generate a sense of expectancy in others",
			"I keep going despite challenges",
			"I enjoy keeping with tradition",
			"I consistently assemble talented teams",
			"I create an environment of positive feedback, encouraging others to reach higher and to press on toward their goals",
			"I generally use humour in a positive way",
			"I regularly ask for feedback on my performance",
			"I always demonstrate an honest respect and appreciation for cultural diversity",
			"I put effective plans together",
			"I exercise regularly to help manage daily stressors",
			"I find it easy to interact with most people",
			"I know what I want and will get it",
			"I take a broad perspective when I plan",
			"I get along with most people",
			"I am satisfied with my life",
			"I want to take responsibility for big decisions",
			"I\'m good at establish relationships with customers",
			"I say what\'s on my mind, regardless of who\'s around",
			"I honestly care about those around me",
			"I avoid breaking rules or regulations",
			"I always want to be better than others",
			"I always ask people to explain their ideas",
			"I have a clear vision for the future",
			"I  determine my own future",
			"I enjoy change",
			"I usually bring out the best in people",
			"I seek relevant information to key questions from several sources",
			"People feel comfortable around me",
			"I\'m usually excited to do things at work",
			"I usually put things in a certain order when solving them",
			"I like to entertain others",
			"I can make quick decisions when the situation merits",
			"It is very important that I meet all my deadlines",
			"I like getting involved in arguments",
			"Others find me to be very approachable",
			"I always try solving solutions creatively",
			"I am a very systematic in my work",
			"I am optimistic about work",
			"I am very good at finishing tasks",
			"I feel very comfortable negotiating with people",
			"I am known as a fun loving person",
			"I rarely feel anxious during important events",
			"I\'ve got an energetic approach to work",
			"I usually understand why people do things",
			"I\'m good at identifying talent",
			"I always asking clarifying questions",
			"I enjoy planning things in detail",
			"I must have procedures to follow",
			"I enjoy intellectually challenging discussions",
			"I know when a situation becomes too stressful",
			"I want to know if I do something wrong at work",
			"I\'m always ready to engage with others, regardless of the topic",
			"I have a strong sense of self-worth",
			"I tend to foster a climate of inclusion, where diverse thoughts are freely shared",
			"I enjoy communicating to groups",
			"I am good at finding the relevant facts",
			"I must always understand the underlying concepts",
			"I always investigate factors to project customers\' future needs",
			"I do not wait to be told what to do",
			"I like working on projects where the risk is high",
			"I enjoy working on complex and demanding problems",
			"I must understand the underlying principles",
			"I always negotiate the best deal",
			"I always approach those in authority with respect",
			"I can recognize and appreciate a great sense of humour in others",
			"I try to make an extra effort to put others at ease with a warm, friendly, and accepting demeanour",
			"I always follow tried and tested methods",
			"I enjoy working with a culturally diverse group of people",
			"I like to work on challenging tasks",
			"I can compose myself under extreme stress",
			"I\'m usually unbiased in situations that involve personal conflicts of interest",
			"I like to convince people about my ideas",
			"I quickly establish rapport with people",
			"I use a combination of logic and experience to solve problems",
			"I am very good at encouraging others",
			"I am very competitive",
			"I \'m very talkative",
			"I actively seek feedback from others to improve my own skills",
			"I understand corporate politics is a reality",
			"I am very energetic",
			"I like to compete with others",
			"I think clearly under pressure",
			"I have a good reputation for patiently and politely listening to others",
			"I like to be in charge",
			"I\'m aware that different skills are required for various situations",
			"I feel comfortable with people I have just met",
			"I am good at predicting people\'s reactions",
			"I clearly understand the connection between customers, products and profits",
			"I look for opportunities to learn about new things",
			"I always try to defuse tense situations with appropriate humour",
			"I always ensure the detail is correct",
			"I deal with feedback in a manner that inspires accountability among colleagues",
			"I give interesting and well-received presentations",
			"I like to experiment with new approaches",
			"I make time for the most important priorities",
			"I see myself more as a traditionalist",
			"My work is an inspiration to others",
			"I feel comfortable dealing with angry people",
			"I can work comfortably with individuals who work very slow",
			"I manage my time effectively to reduce stressful schedules",
			"I enjoy coming up with noval ideas",
			"I enjoy taking risky decisions",
			"I am comfortable talking to strangers",
			"I tend to anticipate customer needs before they ask for it",
			"I work well when put under pressure",
			"I enjoy analysing information",
			"I understand the reasoning behind key policies, practices, and procedures",
			"I always create a climate that treats diverse people with respect",
			"I\'m always open and direct with others, without intimidating them",
			"I am very good at following procedures",
			"I encourage others to be critical of my approach",
			"I enjoy meeting new people",
			"I build effective relationships in the organization",
			"I just keep going regardless of the stress",
			"I make decisions on facts only",
			"I always get involved in activities that will challenge my current skills",
			"I readily adapt to new challenges",
			"I am good at finding ways to motivate people",
			"Being objective in situations that involves personal conflicts of interest is easy to me",
			"I approach new things with a lot of optimism",
			"I always know what is financial viable for the business",
			"I make solid eye contact, intuitively listening to the message",
			"I always need to have rules to follow",
			"I have a clear vision for my life",
			"I always seek to meet the expectations of customers",
			"I know how to make money in the corporate world",
			"Networking with people energises me",
			"I find talking to intellectual people very stimulating",
			"I am optimistic about life",
			"I pay close attention to detail",
			"I enjoy directing the work of others",
			"I work best when working towards a deadline",
			"I am good at selling things",
			"I\'m very good at improving things",
			"I don\'t see a need to change things if they work",
			"I always make things happen",
			"I take the lead in a group",
			"I often develop long term strategies",
			"I need rules to work effectively",
			"I always drive others to deliver quality results",
			"I am good at starting projects",
			"I find it easy to manage multiple tasks",
			"I like to create an inspiring vision for the future",
			"I tend to design methods for implementing plans and for measuring success",
			"I think most people are reliable",
			"I consider the practicality of various solutions",
			"I hold strong opinions on most issues",
			"I am confident when talking to new people",
			"I deal comfortably with those in authority",
			"I continually seek to inspire and be inspired",
			"I\'m optimistic about future possibilities",
			"I\'m usually in control of my emotions, especially when I\'m under pressure",
			"I invest a lot of time and energy in work",
			"I enjoy the challenge of doing something new",
			"I make decisions in a timely manner, even with incomplete information",
			"I always arrange my files files an orderly manner",
			"I follow my own ideas and opinions",
			"I handle risk and uncertainty comfortably",
			"I plan ahead well",
			"I\'m usually calm before an important event",
			"I am confident when I meet new people",
			"I always ensure I meet deadlines",
			"I mostly produce unconventional ideas",
			"I communicate effectively on an array of topics",
			"I work well in a team",
			"I regularly initiate development discussions with others",
			"I co-operate well with others",
			"I always need all the relevant information",
			"I consider career goals of others and help them develop",
			"I usually consider the long term consequences",
			"I put my own interest aside for the sake of reaching results",
			"I work well under pressure",
			"I\'m good at thinking on my feet",
			"I\'m very good at identifying new business opportunities",
			"I implement procedures to work more effectively",
			"I provide tasks to develop others",
			"I like everything to be in its proper place",
			"I am lively",
			"I believe in teamwork",
			"I have a good working relationship with most others",
			"I set clear, realistic, time-bound, and measurable objectives ",
			"I always ensure that all my deliverables are of exceptional quality",
			"I am comfortable taking risks",
			"I always work in an organised way",
			"I interact with a lot of people",
			"I am more practical and hands-on",
			"I never hesitate to go the extra mile to help another person",
			"Maintaining confidentiality is one of my greatest strengths",
			"I always gain complete confidence and trust of authority figures",
			"I cannot work without clearly defined rules",
			"I spend my time on what is important",
			"Being able to motivate people is really important to me",
			"I can adapt traditional ideas to new situations",
			"I tell people when they are wrong, even if it means upsetting them",
			"I am good at resolving disagreements",
			"Procedures helps me plan better",
			"I\'m usually very patient towards others",
			"I like to act on my own initiatives",
			"I always challenging people\'s ideas",
			"It\'s critical for me to the core of a problem",
			"I produce lots of new ideas",
			"I am very confident speaking to big audience",
			"I enjoy knowing why people behave as they do",
			"I am determined to win at all costs",
			"I can persuade others to my point of view",
			"I\'m a high-achiever with a reputation for success and  performance",
			"I usually let people know where they stand",
			"I deliver what I promised",
			"Rules is critical to me to working efficiently",
			"I always need to win",
			"I\'m always direct when giving feedback",
			"I am sure of my own worth",
			"I appreciate the challenge of unfamiliar tasks as an opportunity for learning and growing",
			"Managing stressful situations comes easy to me",
			"I tend to participate in planning sessions with others to efficiently coordinate efforts",
			"I am very good a persuading others",
			"I have a remarkable ability to put myself in other people\'s shoes",
			"I am very open to change",
			"I can effectively motivate people",
			"I  relate well to authority figures",
			"I can quickly assess the strengths and limitations of people",
			"I\'m always willing to listen with empathy",
			"I am very comfortable communicating to different audiences",
			"I tend to refrain from interrupting others, allowing them to make their point",
			"People feel comfortable approaching me with a sensitive matter",
			"I am motivated by praise and recognition",
			"I always look at trends to predict future outcomes",
			"I consider the wider consequences of plans and activities",
			"I always include others in the final decision",
			"I enjoy working on high risk problems",
			"I pursue my work with a lot of drive and determination",
			"I always want things to be done properly",
			"I usually analyse the behaviour of others",
			"I am in control of my life",
			"I\'m very good at spotting the pros and cons of a plan",
			"I tend to present to those in authority with a commanding but unpretentious manner",
			"I always create a compelling vision for my team",
			"People describe me as being extremely thorough",
			"I\'m proficient in a variety of writing styles",
			"I often get enthusiastic about new projects",
			"I am very good at explaining things to people",
			"I frequently experience moments of success",
			"I prefer to learn by doing",
			"I can persevere through long and tedious work routines",
			"I want more responsibility at work",
			"I make my point strongly",
			"I have an independent approach to work",
		);
	}
}