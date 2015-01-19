# phpstardust
CMS based on CakePHP. A CakePHP plugin.

<h2>Requirements</h2>

HTTP Server. For example: Apache.
PHP 5.2.8 or greater.
CakePHP 2.5.1+

<h2>Website</h2>

http://www.phpstardust.org

<h2>Installation</h2>

- compiles the database file in app/Config/database.php (the name must be "default")
- compiles the email file in app/Config/email.php (the name must be "default")
- upload the "Phpstardust" folder in the /app/Plugin folder
- upload the "Themed" folder in the /app/View folder
- upload the "theme" folder in the /app/webroot folder
- activate the plugin in /app/Config/bootstrap.php

CakePlugin::loadAll(array(
    'Phpstardust' => array('bootstrap' => true, 'routes' => true)
));

- edit the configuration variables in /app/Plugin/Phpstardust/Config/bootstrap.php
- install CMS via browser http://your_website/install

<h2>License</h2>

MIT LICENSE

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
