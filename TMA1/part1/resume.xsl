<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:ns="http://part1.com/resume">
    <xsl:output method="html" doctype-system="about:legacy-compat" />
    <xsl:template match="/">
        <html>
            <head>
                <meta charset="utf-8" />
                <link rel = "stylesheet" type = "text/css" href = "/shared/styles.css"/>
                <title>Resume Page</title>
            </head>
            <body>
                <table border="1">
                    <caption>My resume</caption>
                    <thead>
                        <tr>
                            <th colspan="2">General Information</th>
                        </tr>
                    </thead>
                    <tbody>
                        <xsl:for-each select="ns:resume/ns:geninfo">
                            <tr>
                                <td>Name</td>
                                <td>
                                    <xsl:value-of select="ns:name" />
                                </td>
                            </tr>
                            <tr>
                                <td>Age</td>
                                <td>
                                    <xsl:value-of select="ns:age" />
                                </td>
                            </tr>
                            <tr>
                                <td>Hobbies</td>
                                <td>
                                    <xsl:value-of select="ns:hobbies" />
                                </td>
                            </tr>
                            <tr>
                                <td>University</td>
                                <td>
                                    <xsl:value-of select="ns:edubg/ns:uni" />
                                </td>
                            </tr>
                            <tr>
                                <td>Major</td>
                                <td>
                                    <xsl:value-of select="ns:edubg/ns:major" />
                                </td>
                            </tr>
                            <tr>
                                <td>High School</td>
                                <td>
                                    <xsl:value-of select="ns:edubg/ns:prev" />
                                </td>
                            </tr>
                        </xsl:for-each>
                    </tbody>
                    <thead>
                        <tr>
                            <th colspan="2">Work Experience</th>
                        </tr>
                    </thead>
                    <tbody>
                        <xsl:for-each select="ns:resume/ns:workinfo/ns:position">
                            <tr>
                                <td>
                                    <xsl:value-of select="@id" />
                                </td>
                                <td>
                                    <xsl:value-of select="ns:description" />
                                </td>
                            </tr>
                        </xsl:for-each>
                    </tbody>
                </table>
                <div class='main-nav'>
                    <a href="/tma1.htm#q1" type="button" class="cta">&lt; Go back to cover page</a>
                    <a href="/part2/index.html" type="button" class="cta">See next solution &gt;</a>
                </div>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
