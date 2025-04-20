<xsl:stylesheet version="1.0">
	<xsl:output method="html" doctype-system="about:legacy-compat"/>
	
	<xsl:template match="/">
		<html>
			<head>
				<title>Lessons</title>
			</head>

			<body>
				<h1><xsl:value-of select="/course/course_name"></h1>
				<p><strong><xsl:value-of select="/course/prof"/></strong></p>
				
				<xsl:for-each select="/course/content/unit">
					<h3><xsl:value-of select="unit_name"/></h3>
					<ul>
						<xsl:for-each select="sections/section">
							<li><xsl:value-of select="."/></li>
						</xsl:for-each>
					</ul>
				<xsl:for-each>
			</body>	
		</html>
	</xsl:template>
<xsl:stylesheet>