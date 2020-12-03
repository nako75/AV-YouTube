<?PHP

	//AV YouTube - Proxy Visitor
	
	class ProxyVisitor
	{
		
		function __construct($url, $port, $user_agent, $proxy_list){
			//Check if curl is insalled.
			if(function_exists("curl_version")){
				//$this->open_file = file_get_contents($file_name);
				
					//Setting properties.
					$this->url			= $url;
					$this->proxy_list	= $proxy_list;
					$this->port			= $port;
					$this->user_agent	= $user_agent;
					$this->open_site();				
			}else{
				die( "Please enable cURL extension in php.ini file" );
			}
			
		}
		
		private function open_site(){
			
			$exploded_string		= explode(",", $this->proxy_list);
			$random_num_array		= array_rand($exploded_string, 1);
			$random_proxy_			= trim($exploded_string[$random_num_array]);
			
			echo "You're viewing $this->url with proxy: " . $random_proxy_;
			
			$handler = curl_init();
			$header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
			$header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
			$header[] = "Cache-Control: max-age=0";
			$header[] = "Connection: keep-alive";
			$header[] = "Keep-Alive: 300"; 
			
			$curl_headers = array(
			CURLOPT_URL					=> $this->url,
			
			CURLOPT_FOLLOWLOCATION		=> true,
			CURLOPT_RETURNTRANSFER		=> 0,
			CURLOPT_USERAGENT			=> $this->user_agent,
			CURLOPT_HTTPHEADER			=> $header,
			
			CURLOPT_PROXY				=> $random_proxy_,
			CURLOPT_PROXYPORT			=> $this->port
			);
			
		
			curl_setopt_array($handler, $curl_headers);
			curl_exec($handler);
			curl_close($handler);		
			
		}
	}









?>