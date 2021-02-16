xWhoops25
=========

A XOOPS 2.5.11+ module that brings [whoops](https://github.com/filp/whoops) error display to XOOPS. It is especially handy for diagnosing failures brought on by unhandled errors, so you can more properly handle them.

Administrators control access to the extended diagnotics, and any group can be granted or denied access.

Outside of the control panel, there is no user interface. It will "just work" when needed.

To add *xwhoops25* to your XoopsCore25, follow these steps 
- download the distribution archive of your choice
- explode the archive into your system's modules directory
- rename the new directory to xwhoops25
- open a terminal into that directory and execute
  ```composer install```
- install the xwhoops25 module in the system administration module page
- grant access by selecting groups in the permissions section

The Whoops display contains 4 main sections.
- *top left* is the error that was encountered
- *lower left* shows the stack frames, the trace of path of the processing that resulted in the error.
- *top right* shows the code for the currently selected stack frame item. Select a new stack frame to see the related code.
- *lower right* shows environment information such as request parameters, session information, etc.

Note: if the XoopsLogger is enabled, MySQL queries will be shown in the Environment & details section.
