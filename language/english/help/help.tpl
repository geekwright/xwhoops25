<div id="help-template" class="outer">
    <{include file=$smarty.const._MI_XWHOOPS_HELP_HEADER}>


    <h4>Description</h4>
<p>
    xWhoops provides extended error messages for XOOPS using <a href="https://github.com/filp/whoops" class="external">whoops</a>.
    It is primarily intended for developers.
</p>
<p>
    xWhoops messages are only available to user groups that the administrator has <em>selected</em>,
    so on failure, messages can safely be much more informative and detailed.
</p>
<h4>Usage</h4>
<p>
    When an error occurs, xWhoops will display a screen with information about the error.
    <br>
    The Whoops display contains 4 main sections.
    <ul>
    <li><em>top left</em> is the error that was encountered</li>
    <li><em>lower left</em> shows the stack frames, the trace of path of the processing that resulted in the error.</li>
    <li><em>top right</em> shows the code for the currently selected stack frame item. Select a new stack frame to see the related code.</li>
    <li><em>lower right</em> shows environment information such as request parameters, session information, etc.</li>
    </ul>
    Note: if the XoopsLogger is enabled, MySQL queries will be shown in the Environment & details section.
</p>
<h4>Installation</h4>
<p>
    To add <strong>xwhoops25</strong> to your XoopsCore25, follow these steps
    <ul>
    <li>download the distribution archive of your choice</li>
    <li>explode the archive into your system's modules directory</li>
    <li>rename the new directory to xwhoops25</li>
    <li>open a terminal into that directory and execute<br>
        <code>  composer install</code>
    </li>
    <li>install the xwhoops25 module in the system administration module page</li>
    <li>grant access by selecting groups in the permissions section</li>
    </ul>
</p>
</div>
