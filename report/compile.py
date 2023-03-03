import os
import sys
from pathlib import Path

directory = Path(sys.argv[1]).resolve()

files = [(file, directory / (file.stem + ".pdf"))
         for file in directory.iterdir()
         if file.suffix == ".md"
         ]

print(f"Compiling: {len(files)}")
for input, output in files:
    print(f"\t{input}")
    os.system(f'pandoc "{input}" -o "{output}"')
print("Done!")
