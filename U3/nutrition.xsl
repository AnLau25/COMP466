<xsl:stylesheet version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" doctype-system="about:legacy-compat" />
    <xsl:template match="/">
        <html>
            <head>
                <meta charset="utf-8" />
                <title>Grancookies</title>
            </head>
            <body>
                <table border="1">
                    <caption>Product Description</caption>
                    <thead>
                        <tr>
                            <th>Info</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <xsl:for-each select="/cookiePack/branding">
                            <tr>
                                <td>Brand Name</td>
                                <td><xsl:value-of select="brandName"/></td>
                            </tr>
                            <tr>
                                <td>Serving</td>
                                <td><xsl:value-of select="serving"/></td>
                            </tr>
                        </xsl:for-each>
                        <xsl:for-each select="/cookiePack/nutLabel/fact">
                            <tr>
                                <td><xsl:value-of select="@id"/></td>
                                <td><xsl:value-of select="value"/></td>
                            </tr>
                        </xsl:for-each>
                    </tbody>
                </table>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>


<!--Ex_15.9
    The superior method was to add the descriptors to the thing instead of making them theyr own element since it is a single cookie box
    Now, if there were any cookieBoxes, you would need to make those iterable elemnts
    So like, elements: id(would be the fact), content(number goes here)-->