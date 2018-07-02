<?php
	function sendOkResponse($message,$response){
		$newResponse = $response->withStatus(200)->withHeader('Content-type','application/json');
		$newResponse->getBody()->write($message);
		return $newResponse;
	}
?>