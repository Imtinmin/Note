#include <stdio.h>
#include <stdlib.h>

int main(int argc, char const *argv[])
{
	int i;
	srand(1);
	for (int i = 0; i < 10; ++i)
	{
		printf("%d\n",rand()%6 + 1);
	}
	return 0;
}