<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <!-- Template to match the root element and start the HTML document -->
    <xsl:template match="/">
        <html>
            <head>
                <title>Person Information</title>
            </head>
            <body>
                <!-- Apply the template for the 'person' element -->
                <xsl:apply-templates select="person"/>
            </body>
        </html>
    </xsl:template>

    <!-- Template to match the 'person' element -->
    <xsl:template match="person">
        <h1>Person Information</h1>
        <ul>
            <!-- Apply the template for child elements -->
            <xsl:apply-templates/>
        </ul>
    </xsl:template>

    <!-- Template to match text nodes and create list items -->
    <xsl:template match="text()">
        <li>
            <xsl:value-of select="."/>
        </li>
    </xsl:template>

</xsl:stylesheet>
