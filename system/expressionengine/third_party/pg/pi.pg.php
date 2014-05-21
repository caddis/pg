<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

$plugin_info = array (
	'pi_name' => 'PG',
	'pi_version' => '1.0.0',
	'pi_author' => 'Caddis',
	'pi_author_url' => 'http://www.caddis.co',
	'pi_description' => 'A tag pair to loop through all GET/POST parameters.',
	'pi_usage' => Pg::usage()
);

class Pg {

	public $return_data = '';

	public function __construct()
	{
		$method = ee()->TMPL->fetch_param('method', 'get');

		$data = ($method == 'get') ? $_GET : $_POST;

		$variables = array();

		foreach ($data as $key => $value) {
			$variables[] = array(
				'key' => ee()->security->xss_clean($key),
				'value' => ee()->security->xss_clean($value)
			);
		}

		$this->return_data = ee()->TMPL->parse_variables(ee()->TMPL->tagdata, $variables);
	}

	function usage()
	{
		ob_start();
?>
Example:

URL: www.domain.com/test?key=value&key2=value2

Tag pair:

{exp:pg}
{key}: {value}<br>
{/exp:pg}

Output:
key: value
key2: value2

Optional paramter: method="post"
This will get post data instead of get data.

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