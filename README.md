# PG 1.0.0

A tag pair to loop through all GET/POST parameters in ExpressionEngine.

## Usage

Example URL: www.domain.com/test?key=value&key2=value2

### Tag pair:

	{exp:pg}
		{key}: {value}<br>
	{/exp:pg}

### Output:

	value: key
	value2: key2

Optional paramter: method="post"  
This will get post data instead of get data.

### Example:

	{exp:pg method="post"}
		{key}: {value}<br>
	{/exp:pg}

## License

Copyright 2014 Caddis Interactive, LLC

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

	http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.