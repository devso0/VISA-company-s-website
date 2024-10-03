package readandedit;

import java.io.File;

import com.syncfusion.docio.*;

public class ReadAndEdit {

	public static void main(String[] args) throws Exception {
		//Opens the Word template document
		WordDocument document = new WordDocument();
		//Opens the template Word document.
		String basePath = getDataDir("Template.docx");
		document.open(basePath, FormatType.Docx);
		//Gets the last paragraph
		IWParagraph paragraph = document.getLastParagraph();
		//Gets the text range and modifies its content.
		WTextRange textRange=(WTextRange) paragraph.getItems().get(0);
		textRange.setText("Syncfusion");
		//Saves the Word document
		document.save("Result.docx");
		//Closes the document
                document.close();
        
	    System.out.println("Document generated successfully");
	}
	/**
	 * Get the file path
	 * 
	 * @param path specifies the file path
	 */
	private static String getDataDir(String path) {
		File dir = new File(System.getProperty("user.dir"));
		if (!(dir.toString().endsWith("Java-Create-Word-Examples")))
			dir = dir.getParentFile();
		dir = new File(dir, "resources");
		dir = new File(dir, path);
		if (dir.isDirectory() == false)
			dir.mkdir();
		return dir.toString();
	}
}