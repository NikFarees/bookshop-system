import pandas as pd
import os
from pathlib import Path


def safe_filename(name: str) -> str:
    """Make a sheet name safe for file systems."""
    bad_chars = ['\\', '/', ':', '*', '?', '"', '<', '>', '|']
    for ch in bad_chars:
        name = name.replace(ch, '_')
    name = name.replace(' ', '_').strip('_')
    return name or "sheet"


def convert_xlsx_to_csv(xlsx_file: str, output_dir: str = "output") -> None:
    """Convert an XLSX file with multiple sheets to separate CSV files."""
    if not os.path.isfile(xlsx_file):
        print(f"Error: File not found -> {xlsx_file}")
        return

    Path(output_dir).mkdir(parents=True, exist_ok=True)

    xls = pd.ExcelFile(xlsx_file)
    sheet_names = xls.sheet_names

    print(f"\nFound {len(sheet_names)} sheet(s) in: {xlsx_file}")
    print(f"Saving CSV files into: {os.path.abspath(output_dir)}\n")

    for sheet_name in sheet_names:
        try:
            df = pd.read_excel(xlsx_file, sheet_name=sheet_name)

            csv_filename = f"{safe_filename(sheet_name)}.csv"
            csv_filepath = os.path.join(output_dir, csv_filename)

            df.to_csv(csv_filepath, index=False, encoding="utf-8-sig")
            print(f"✓ '{sheet_name}' -> {csv_filename} (Rows: {len(df)}, Cols: {len(df.columns)})")

        except Exception as e:
            print(f"✗ Error converting sheet '{sheet_name}': {e}")

    print("\nConversion complete!")


if __name__ == "__main__":
    xlsx_file = input("Enter XLSX file path (e.g. /home/user/file.xlsx): ").strip().strip('"').strip("'")
    if not xlsx_file:
        print("Error: No file path provided.")
        raise SystemExit(1)

    output_directory = input("Enter output folder (press Enter for 'output'): ").strip().strip('"').strip("'") or "output"

    convert_xlsx_to_csv(xlsx_file, output_directory)