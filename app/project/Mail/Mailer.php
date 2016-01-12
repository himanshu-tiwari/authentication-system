<?php

namespace project\Mail;

class Mailer{
	protected $view;

	protected $mailer;

	protected $config;

	public function __construct($view, $config, $mailer){
		$this->view = $view;
		$this->mailer = $mailer; 
		$this->config = $config; 
	}

	public function send($template, $data, $callback){
		$builder = $this->mailer->MessageBuilder();

		$message = new Message($builder);
		$message->from($this->config->get('mail.from'));

		$this->view->appendData($data);

		$message->body($this->view->render($template));

		call_user_func($callback, $message);

		$domain = $this->config->get('mail.domain');
		$this->mailer->post("{$domain}/messages", $builder->getMessage());
	}
}

?>