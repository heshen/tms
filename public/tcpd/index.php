<?php
//use Illuminate\Support\Facades\DB;
//use App\Notes;
require_once('./tcpdf.php');
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
//$data= DB::table('notes')->find(19);
//var_dump($data);
// 设置文档信息
$pdf->SetCreator('Helloweba');
$pdf->SetAuthor('yueguangguang');
$pdf->SetTitle('Welcome to helloweba.com!');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, PHP');

// 设置页眉和页脚信息
//$pdf->SetHeaderData('logo.png', 30, 'Helloweba.com', '致力于WEB前端技术在中国的应用',
//    array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// 设置页眉和页脚字体
$pdf->setHeaderFont(Array('stsongstdlight', '', '10'));
$pdf->setFooterFont(Array('helvetica', '', '8'));

// 设置默认等宽字体
$pdf->SetDefaultMonospacedFont('courier');

// 设置间距
$pdf->SetMargins(15, 27, 15);
$pdf->SetHeaderMargin(5);
$pdf->SetFooterMargin(10);

// 设置分页
$pdf->SetAutoPageBreak(TRUE, 25);

// set image scale factor
$pdf->setImageScale(1.25);

// set default font subsetting mode
$pdf->setFontSubsetting(true);

//设置字体
$pdf->SetFont('stsongstdlight', '', 14);

$pdf->AddPage();

$html = '<h1 id="h1-u4E2Du95F4u4EF6u53C2u8003u5B98u65B9u6587u6863"><a name="中间件参考官方文档" class="reference-link"></a><span class="header-link octicon octicon-link"></span><a href="http://laravelacademy.org/post/6738.html">中间件参考官方文档</a></h1><p><img src="/uploads/dacb19474f339b6b716418020dbab9e9.png" alt=""></p>
<p>HTTP 中间件为过滤进入应用的 HTTP 请求提供了一套便利的机制。例如，Laravel 内置了一个中间件来验证用户是否经过认证，如果用户没有经过认证，中间件会将用户重定向到登录页面，否则如果用户经过认证，中间件就会允许请求继续往前进入下一步操作。</p>
<p>当然，除了认证之外，中间件还可以被用来处理更多其它任务。比如：CORS 中间件可以用于为离开站点的响应添加合适的头（跨域）；日志中间件可以记录所有进入站点的请求。</p>
<p>Laravel框架自带了一些中间件，包括认证、CSRF 保护中间件等等。所有的中间件都位于 app/Http/Middleware 目录。</p>
<h2 id="h2-u521Bu5EFAu4E2Du95F4u4EF6"><a name="创建中间件" class="reference-link"></a><span class="header-link octicon octicon-link"></span>创建中间件</h2><p>这个命令会在 app/Http/Middleware 目录下创建一个新的中间件类 </p>
<pre class="prettyprint linenums prettyprinted"><ol class="linenums"><li class="L0"><code><span class="pln">php artisan make</span><span class="pun">:</span><span class="pln">middleware checkAge </span><span class="com">//(中间件名称)</span></code></li></ol></pre><pre class="prettyprint linenums prettyprinted"><ol class="linenums"><li class="L0"><code><span class="pun">&lt;?</span><span class="pln">php</span></code></li><li class="L1"><code></code></li><li class="L2"><code><span class="kwd">namespace</span><span class="pln"> </span><span class="typ">App</span><span class="pln">\Http\Middleware</span><span class="pun">;</span></code></li><li class="L3"><code></code></li><li class="L4"><code><span class="kwd">use</span><span class="pln"> </span><span class="typ">Closure</span><span class="pun">;</span></code></li><li class="L5"><code></code></li><li class="L6"><code><span class="kwd">class</span><span class="pln"> </span><span class="typ">CheckAge</span></code></li><li class="L7"><code><span class="pun">{</span></code></li><li class="L8"><code><span class="pln">    </span><span class="com">/**</span></code></li><li class="L9"><code><span class="com">     * 返回请求过滤器</span></code></li><li class="L0"><code><span class="com">     *</span></code></li><li class="L1"><code><span class="com">     * @param \Illuminate\Http\Request $request</span></code></li><li class="L2"><code><span class="com">     * @param \Closure $next</span></code></li><li class="L3"><code><span class="com">     * @return mixed</span></code></li><li class="L4"><code><span class="com">     */</span></code></li><li class="L5"><code><span class="pln">    </span><span class="kwd">public</span><span class="pln"> </span><span class="kwd">function</span><span class="pln"> handle</span><span class="pun">(</span><span class="pln">$request</span><span class="pun">,</span><span class="pln"> </span><span class="typ">Closure</span><span class="pln"> $next</span><span class="pun">)</span></code></li><li class="L6"><code><span class="pln">    </span><span class="pun">{</span></code></li><li class="L7"><code><span class="pln">        </span><span class="kwd">if</span><span class="pln"> </span><span class="pun">(</span><span class="pln">$request</span><span class="pun">-&gt;</span><span class="pln">input</span><span class="pun">(</span><span class="str">\'age\'</span><span class="pun">)</span><span class="pln"> </span><span class="pun">&lt;=</span><span class="pln"> </span><span class="lit">200</span><span class="pun">)</span><span class="pln"> </span><span class="pun">{</span></code></li><li class="L8"><code><span class="pln">            </span><span class="kwd">return</span><span class="pln"> redirect</span><span class="pun">(</span><span class="str">\'home\'</span><span class="pun">);</span></code></li><li class="L9"><code><span class="pln">        </span><span class="pun">}</span></code></li><li class="L0"><code></code></li><li class="L1"><code><span class="pln">        </span><span class="kwd">return</span><span class="pln"> $next</span><span class="pun">(</span><span class="pln">$request</span><span class="pun">);</span></code></li><li class="L2"><code><span class="pln">    </span><span class="pun">}</span></code></li><li class="L3"><code></code></li><li class="L4"><code><span class="pun">}</span></code></li></ol></pre><h2 id="h2-u6CE8u518Cu4E2Du95F4u4EF6"><a name="注册中间件" class="reference-link"></a><span class="header-link octicon octicon-link"></span>注册中间件</h2><p>app/Http/Kernel.php</p>
<h2 id="h2-u4F7Fu7528u4E2Du95F4u4EF6"><a name="使用中间件" class="reference-link"></a><span class="header-link octicon octicon-link"></span>使用中间件</h2><h1 id="h1-u4E2Du95F4u4EF6u53C2u8003u5B98u65B9u6587u6863"><a name="中间件参考官方文档" class="reference-link"></a><span class="header-link octicon octicon-link"></span><a href="http://laravelacademy.org/post/6738.html">中间件参考官方文档</a></h1><p><img src="/uploads/dacb19474f339b6b716418020dbab9e9.png" alt=""></p>
<p>HTTP 中间件为过滤进入应用的 HTTP 请求提供了一套便利的机制。例如，Laravel 内置了一个中间件来验证用户是否经过认证，如果用户没有经过认证，中间件会将用户重定向到登录页面，否则如果用户经过认证，中间件就会允许请求继续往前进入下一步操作。</p>
<p>当然，除了认证之外，中间件还可以被用来处理更多其它任务。比如：CORS 中间件可以用于为离开站点的响应添加合适的头（跨域）；日志中间件可以记录所有进入站点的请求。</p>
<p>Laravel框架自带了一些中间件，包括认证、CSRF 保护中间件等等。所有的中间件都位于 app/Http/Middleware 目录。</p>
<h2 id="h2-u521Bu5EFAu4E2Du95F4u4EF6"><a name="创建中间件" class="reference-link"></a><span class="header-link octicon octicon-link"></span>创建中间件</h2><p>这个命令会在 app/Http/Middleware 目录下创建一个新的中间件类 </p>
<pre class="prettyprint linenums prettyprinted"><ol class="linenums"><li class="L0"><code><span class="pln">php artisan make</span><span class="pun">:</span><span class="pln">middleware checkAge </span><span class="com">//(中间件名称)</span></code></li></ol></pre><pre class="prettyprint linenums prettyprinted"><ol class="linenums"><li class="L0"><code><span class="pun">&lt;?</span><span class="pln">php</span></code></li><li class="L1"><code></code></li><li class="L2"><code><span class="kwd">namespace</span><span class="pln"> </span><span class="typ">App</span><span class="pln">\Http\Middleware</span><span class="pun">;</span></code></li><li class="L3"><code></code></li><li class="L4"><code><span class="kwd">use</span><span class="pln"> </span><span class="typ">Closure</span><span class="pun">;</span></code></li><li class="L5"><code></code></li><li class="L6"><code><span class="kwd">class</span><span class="pln"> </span><span class="typ">CheckAge</span></code></li><li class="L7"><code><span class="pun">{</span></code></li><li class="L8"><code><span class="pln">    </span><span class="com">/**</span></code></li><li class="L9"><code><span class="com">     * 返回请求过滤器</span></code></li><li class="L0"><code><span class="com">     *</span></code></li><li class="L1"><code><span class="com">     * @param \Illuminate\Http\Request $request</span></code></li><li class="L2"><code><span class="com">     * @param \Closure $next</span></code></li><li class="L3"><code><span class="com">     * @return mixed</span></code></li><li class="L4"><code><span class="com">     */</span></code></li><li class="L5"><code><span class="pln">    </span><span class="kwd">public</span><span class="pln"> </span><span class="kwd">function</span><span class="pln"> handle</span><span class="pun">(</span><span class="pln">$request</span><span class="pun">,</span><span class="pln"> </span><span class="typ">Closure</span><span class="pln"> $next</span><span class="pun">)</span></code></li><li class="L6"><code><span class="pln">    </span><span class="pun">{</span></code></li><li class="L7"><code><span class="pln">        </span><span class="kwd">if</span><span class="pln"> </span><span class="pun">(</span><span class="pln">$request</span><span class="pun">-&gt;</span><span class="pln">input</span><span class="pun">(</span><span class="str">\'age\'</span><span class="pun">)</span><span class="pln"> </span><span class="pun">&lt;=</span><span class="pln"> </span><span class="lit">200</span><span class="pun">)</span><span class="pln"> </span><span class="pun">{</span></code></li><li class="L8"><code><span class="pln">            </span><span class="kwd">return</span><span class="pln"> redirect</span><span class="pun">(</span><span class="str">\'home\'</span><span class="pun">);</span></code></li><li class="L9"><code><span class="pln">        </span><span class="pun">}</span></code></li><li class="L0"><code></code></li><li class="L1"><code><span class="pln">        </span><span class="kwd">return</span><span class="pln"> $next</span><span class="pun">(</span><span class="pln">$request</span><span class="pun">);</span></code></li><li class="L2"><code><span class="pln">    </span><span class="pun">}</span></code></li><li class="L3"><code></code></li><li class="L4"><code><span class="pun">}</span></code></li></ol></pre><h2 id="h2-u6CE8u518Cu4E2Du95F4u4EF6"><a name="注册中间件" class="reference-link"></a><span class="header-link octicon octicon-link"></span>注册中间件</h2><p>app/Http/Kernel.php</p>
<h2 id="h2-u4F7Fu7528u4E2Du95F4u4EF6"><a name="使用中间件" class="reference-link"></a><span class="header-link octicon octicon-link"></span>使用中间件</h2><h1 id="h1-u4E2Du95F4u4EF6u53C2u8003u5B98u65B9u6587u6863"><a name="中间件参考官方文档" class="reference-link"></a><span class="header-link octicon octicon-link"></span><a href="http://laravelacademy.org/post/6738.html">中间件参考官方文档</a></h1><p><img src="/uploads/dacb19474f339b6b716418020dbab9e9.png" alt=""></p>
<p>HTTP 中间件为过滤进入应用的 HTTP 请求提供了一套便利的机制。例如，Laravel 内置了一个中间件来验证用户是否经过认证，如果用户没有经过认证，中间件会将用户重定向到登录页面，否则如果用户经过认证，中间件就会允许请求继续往前进入下一步操作。</p>
<p>当然，除了认证之外，中间件还可以被用来处理更多其它任务。比如：CORS 中间件可以用于为离开站点的响应添加合适的头（跨域）；日志中间件可以记录所有进入站点的请求。</p>
<p>Laravel框架自带了一些中间件，包括认证、CSRF 保护中间件等等。所有的中间件都位于 app/Http/Middleware 目录。</p>
<h2 id="h2-u521Bu5EFAu4E2Du95F4u4EF6"><a name="创建中间件" class="reference-link"></a><span class="header-link octicon octicon-link"></span>创建中间件</h2><p>这个命令会在 app/Http/Middleware 目录下创建一个新的中间件类 </p>
<pre class="prettyprint linenums prettyprinted"><ol class="linenums"><li class="L0"><code><span class="pln">php artisan make</span><span class="pun">:</span><span class="pln">middleware checkAge </span><span class="com">//(中间件名称)</span></code></li></ol></pre><pre class="prettyprint linenums prettyprinted"><ol class="linenums"><li class="L0"><code><span class="pun">&lt;?</span><span class="pln">php</span></code></li><li class="L1"><code></code></li><li class="L2"><code><span class="kwd">namespace</span><span class="pln"> </span><span class="typ">App</span><span class="pln">\Http\Middleware</span><span class="pun">;</span></code></li><li class="L3"><code></code></li><li class="L4"><code><span class="kwd">use</span><span class="pln"> </span><span class="typ">Closure</span><span class="pun">;</span></code></li><li class="L5"><code></code></li><li class="L6"><code><span class="kwd">class</span><span class="pln"> </span><span class="typ">CheckAge</span></code></li><li class="L7"><code><span class="pun">{</span></code></li><li class="L8"><code><span class="pln">    </span><span class="com">/**</span></code></li><li class="L9"><code><span class="com">     * 返回请求过滤器</span></code></li><li class="L0"><code><span class="com">     *</span></code></li><li class="L1"><code><span class="com">     * @param \Illuminate\Http\Request $request</span></code></li><li class="L2"><code><span class="com">     * @param \Closure $next</span></code></li><li class="L3"><code><span class="com">     * @return mixed</span></code></li><li class="L4"><code><span class="com">     */</span></code></li><li class="L5"><code><span class="pln">    </span><span class="kwd">public</span><span class="pln"> </span><span class="kwd">function</span><span class="pln"> handle</span><span class="pun">(</span><span class="pln">$request</span><span class="pun">,</span><span class="pln"> </span><span class="typ">Closure</span><span class="pln"> $next</span><span class="pun">)</span></code></li><li class="L6"><code><span class="pln">    </span><span class="pun">{</span></code></li><li class="L7"><code><span class="pln">        </span><span class="kwd">if</span><span class="pln"> </span><span class="pun">(</span><span class="pln">$request</span><span class="pun">-&gt;</span><span class="pln">input</span><span class="pun">(</span><span class="str">\'age\'</span><span class="pun">)</span><span class="pln"> </span><span class="pun">&lt;=</span><span class="pln"> </span><span class="lit">200</span><span class="pun">)</span><span class="pln"> </span><span class="pun">{</span></code></li><li class="L8"><code><span class="pln">            </span><span class="kwd">return</span><span class="pln"> redirect</span><span class="pun">(</span><span class="str">\'home\'</span><span class="pun">);</span></code></li><li class="L9"><code><span class="pln">        </span><span class="pun">}</span></code></li><li class="L0"><code></code></li><li class="L1"><code><span class="pln">        </span><span class="kwd">return</span><span class="pln"> $next</span><span class="pun">(</span><span class="pln">$request</span><span class="pun">);</span></code></li><li class="L2"><code><span class="pln">    </span><span class="pun">}</span></code></li><li class="L3"><code></code></li><li class="L4"><code><span class="pun">}</span></code></li></ol></pre><h2 id="h2-u6CE8u518Cu4E2Du95F4u4EF6"><a name="注册中间件" class="reference-link"></a><span class="header-link octicon octicon-link"></span>注册中间件</h2><p>app/Http/Kernel.php</p>
<h2 id="h2-u4F7Fu7528u4E2Du95F4u4EF6"><a name="使用中间件" class="reference-link"></a><span class="header-link octicon octicon-link"></span>使用中间件</h2>';

$pdf->writeHTML($html, true, false, true, false, '');

//输出PDF
$pdf->Output('t.pdf', 'I');