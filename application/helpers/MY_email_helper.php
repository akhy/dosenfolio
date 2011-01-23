<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('getMails'))
{
	function getMails($input, $isSafe = TRUE)
	{
		$emails = '';
		if ($input != '')
		{
			$emails = array();
			
			$mails = explode(' ', $input);
			$mails = implode('', $mails);
			$mails = explode(',', $mails);
			
			$n = 0;
			foreach($mails as $mail)
			{
				if (valid_email($mail))
				{
					if ($isSafe)
						$mailCetak = safe_mailto($mail);
					else
						$mailCetak = $mail;
						
					$emails[$n] = '<span class="email">' . $mailCetak . '</span>';
				}
				else
				{
					$emails[$n] = $mail;
				}
				$n++;
			}
			$emails = implode(', ', $emails);
		}
		return $emails;
	}
	
}

if ( ! function_exists('getFirstMail'))
{
	function getFirstMail($input)
	{
		$emails = '';
		if ($input != '')
		{
			$emails = array();
			
			$mails = explode(' ', $input);
			$mails = implode('', $mails);
			$mails = explode(',', $mails);
			
			if (valid_email($mails[0]))
			{
				return $mails[0];
			}
		}
		return $emails;
	}
}