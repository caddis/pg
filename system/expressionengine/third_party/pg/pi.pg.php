<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

$plugin_info = array (
	'pi_name' => 'PG',
	'pi_version' => '1.1.0',
	'pi_author' => 'Caddis',
	'pi_author_url' => 'http://www.caddis.co',
	'pi_description' => 'Fetch a single request value or loop through all GET/POST parameters.',
	'pi_usage' => Pg::usage()
);

class Pg {

	public $return_data = '';

	public function __construct()
	{
		// Fetch parameters
		$method = ee()->TMPL->fetch_param('method', 'get');

		$data = ($method == 'get') ? $_GET : $_POST;

		$variables = array();

		// Loop through all parameters
		foreach ($data as $key => $value) {
			$variables[] = array(
				'key' => ee()->security->xss_clean($key),
				'value' => ee()->security->xss_clean($value)
			);
		}

		$this->return_data = ee()->TMPL->parse_variables(ee()->TMPL->tagdata, $variables);
	}

	public function param()
	{
		// Fetch parameters
		$key = ee()->TMPL->fetch_param('key', false);
		$method = ee()->TMPL->fetch_param('method', 'get');

		if ($key !== false) {
			return ($method == 'get') ? ee()->input->get($key) : ee()->input->post($key);
		}

		return '';
	}

	function usage()
	{
		ob_start();
?>
A plugin to retrieve GET/POST parameters.

# Usage

Example URL: www.domain.com/test?key=value&key2=value2

Single Tag:

{exp:pg:param key="key2"}

Output:
value2

Tag pair:

{exp:pg}
{key}: {value}<br>
{/exp:pg}

Output:
key: value
key2: value2

Optional parameter for both the single tag and the tag pair: method="post"
This will fetch POST data instead of GET data.

Example:
{exp:pg method="post"}
{key}: {value}<br>
{/exp:pg}
<?php
		$buffer = ob_get_contents();

		ob_end_clean();

		return $buffer;
	}
}